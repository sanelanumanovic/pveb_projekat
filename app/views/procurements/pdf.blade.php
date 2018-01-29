<!DOCTYPE html>
<html>
    <head>
        <title> </title>
        <link rel="stylesheet" type="text/css" href="./css/common.css">
    </head>
    <body>
        <h2>Nabavke u periodu od {{date('d.m.Y.', strtotime($fromDate))}} do {{date('d.m.Y.', strtotime($toDate))}}</h2>
        <table class="report_tables">
            <thead>
            <tr>
                <th>Tip</th>
                <th>Id</th>
                <th>Datum</th>
                <th>Iznos</th>
            </tr>
            </thead>
            <tbody>
                @foreach($modelData as $key => $data)
                    <tr>
                        <td>{{$data->info}}</td>
                        <td>{{$data->id}}</td>
                        <td>{{date('d.m.Y.', strtotime($data->date))}}</td>
                        <td align="right">{{number_format($data->total, 2)}}</td>
                    </tr>
                    @endforeach
            </tbody>
        </table>
    </body>
</html>