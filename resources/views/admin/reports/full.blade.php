<!DOCTYPE html>
<html>
<head>
    <title>Full Report</title>
    <style>
        /* Add your PDF styling here */
    </style>
</head>
<body>
    <div class="header">
        <h1>Full Report</h1>
        @if($startDate && $endDate) 
        <h3>Period: {{ date('d M Y', strtotime($startDate)) }} - {{ date('d M Y', strtotime($endDate)) }}</h3>
        @endif
    </div>

    @foreach($sections as $section)
        @include('admin.reports.sections.' . $section, ['data' => $data[$section] ?? null])
    @endforeach
</body>
</html> 