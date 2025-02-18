<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Google\Analytics\Data\V1beta\BetaAnalyticsDataClient;
use Google\Analytics\Data\V1beta\RunReportRequest;
use Google\Analytics\Data\V1beta\DateRange;
use Google\Analytics\Data\V1beta\Metric;
use Google\Analytics\Data\V1beta\MinuteRange;
use Google\Analytics\Data\V1beta\Dimension;
use Google\Analytics\Data\V1beta\OrderBy;
use Google\Analytics\Data\V1beta\DimensionOrderBy;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
        try {
            // Get total revenue
            $totalRevenue = DB::table('payments')->sum('amount') / 100;
            
            // Get active users count
            $activeUsers = $this->getActiveUsers() ?? 0;

            return view('admin.home', [
                'totalRevenue' => number_format($totalRevenue, 2),
                'activeUsers' => $activeUsers
            ]);
        } catch (\Exception $e) {
            \Log::error('Error: ' . $e->getMessage());
            return view('admin.home', [
                'totalRevenue' => '0.00',
                'activeUsers' => 0
            ]);
        }
    }

    private function getActiveUsers()
    {
        try {
            $credentialsPath = storage_path('app/analytics/service-account-credentials.json');
            
            if (!file_exists($credentialsPath)) {
                \Log::warning('GA4 credentials file not found');
                return 0;
            }

            $credentials = json_decode(file_get_contents($credentialsPath), true);
            $client = new BetaAnalyticsDataClient([
                'credentials' => $credentials
            ]);

            $propertyId = env('GOOGLE_ANALYTICS_PROPERTY_ID');
            $property = 'properties/' . $propertyId;

            $request = new RunReportRequest([
                'property' => $property,
                'dateRanges' => [
                    new DateRange([
                        'start_date' => 'today',
                        'end_date' => 'today',
                    ]),
                ],
                'metrics' => [
                    new Metric([
                        'name' => 'realTimeUsers'
                    ]),
                ],
            ]);

            $response = $client->runReport($request);
            
            if (!empty($response->getRows())) {
                $value = $response->getRows()[0]->getMetricValues()[0]->getValue();
                return (int)$value;
            }
            
            return 0;

        } catch (\Exception $e) {
            \Log::error('GA4 Error: ' . $e->getMessage());
            return 0;
        }
    }

    public function getRevenueData(Request $request)
    {
        try {
            $period = $request->query('period', 'daily');
            $now = now();
            $startDate = match($period) {
                'monthly' => $now->subMonths(11),
                'weekly' => $now->subWeeks(11),
                default => $now->subDays(29)
            };

            // Direct SQL query to get revenue data
            $query = match($period) {
                'monthly' => "
                    SELECT DATE_FORMAT(created_at, '%Y-%m') as date,
                           SUM(amount)/100 as total
                    FROM payments
                    WHERE created_at >= ?
                    GROUP BY DATE_FORMAT(created_at, '%Y-%m')
                    ORDER BY date",
                'weekly' => "
                    SELECT YEARWEEK(created_at) as date,
                           SUM(amount)/100 as total
                    FROM payments
                    WHERE created_at >= ?
                    GROUP BY YEARWEEK(created_at)
                    ORDER BY date",
                default => "
                    SELECT DATE(created_at) as date,
                           SUM(amount)/100 as total
                    FROM payments
                    WHERE created_at >= ?
                    GROUP BY DATE(created_at)
                    ORDER BY date"
            };

            $results = DB::select($query, [$startDate]);

            $labels = [];
            $values = [];
            $totalRevenue = 0;

            foreach ($results as $row) {
                $date = match($period) {
                    'monthly' => \Carbon\Carbon::createFromFormat('Y-m', $row->date)->format('M Y'),
                    'weekly' => 'Week ' . substr($row->date, -2) . '/' . substr($row->date, 0, 4),
                    default => \Carbon\Carbon::parse($row->date)->format('M d')
                };

                $labels[] = $date;
                $values[] = (float)$row->total;
                $totalRevenue += $row->total;
            }

            // Log the data for debugging
            \Log::info('Revenue Data:', [
                'period' => $period,
                'labels' => $labels,
                'values' => $values,
                'total' => $totalRevenue
            ]);

            return response()->json([
                'labels' => $labels,
                'values' => $values,
                'totalRevenue' => number_format($totalRevenue, 2)
            ]);

        } catch (\Exception $e) {
            \Log::error('Revenue Data Error: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to fetch revenue data'], 500);
        }
    }

    // Add this debug function to check raw data
    public function debugPayments()
    {
        $payments = DB::table('payments')
            ->select('id', 'amount', 'created_at')
            ->orderBy('created_at')
            ->get();

        foreach ($payments as $payment) {
            echo "ID: {$payment->id}, Amount: RM" . ($payment->amount/100) . 
                 ", Date: {$payment->created_at}<br>";
        }
    }
} 