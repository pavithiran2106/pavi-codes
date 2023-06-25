<?php
// Fetch and decode the JSON data
$jsonData = '{
  "help": "https://data.gov.sg/api/3/action/help_show?name=datastore_search",
  "success": true,
  "result": {
    "resource_id": "6228c3c5-03bd-4747-bb10-85140f87168b",
    "fields": [
      {"type": "int4", "id": "_id"},
      {"type": "text", "id": "date"},
      {"type": "text", "id": "day"},
      {"type": "text", "id": "holiday"}
    ],
    "records": [
      {"date": "2020-01-01", "holiday": "New Year\'s Day", "_id": 1, "day": "Wednesday"},
      {"date": "2020-01-25", "holiday": "Chinese New Year", "_id": 2, "day": "Saturday"},
      {"date": "2020-01-26", "holiday": "Chinese New Year", "_id": 3, "day": "Sunday"},
      {"date": "2020-04-10", "holiday": "Good Friday", "_id": 4, "day": "Friday"},
      {"date": "2020-05-01", "holiday": "Labour Day", "_id": 5, "day": "Friday"},
      {"date": "2020-05-07", "holiday": "Vesak Day", "_id": 6, "day": "Thursday"},
      {"date": "2020-05-24", "holiday": "Hari Raya Puasa", "_id": 7, "day": "Sunday"},
      {"date": "2020-07-10", "holiday": "Polling Day", "_id": 8, "day": "Friday"},
      {"date": "2020-07-31", "holiday": "Hari Raya Haji", "_id": 9, "day": "Friday"},
      {"date": "2020-08-09", "holiday": "National Day", "_id": 10, "day": "Sunday"}
    ],
    "_links": {
      "start": "/api/action/datastore_search?limit=10&resource_id=6228c3c5-03bd-4747-bb10-85140f87168b",
      "next": "/api/action/datastore_search?offset=10&limit=10&resource_id=6228c3c5-03bd-4747-bb10-85140f87168b"
    },
    "limit": 10,
    "total": 12
  }
}';

$data = json_decode($jsonData, true);

// Extract the holiday records
$records = $data['result']['records'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Public Holidays</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <link rel="stylesheet" type="text/css" href="holiday.css">
</head>
<body>
  <h1>Public Holidays</h1>

  <table>
    <thead>
      <tr>
        <th>Date</th>
        <th>Holiday Name</th>
        <th>Day</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($records as $record) { ?>
        <tr>
          <td><?php echo $record['date']; ?></td>
          <td><?php echo $record['holiday']; ?></td>
          <td><?php echo $record['day']; ?></td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</body>
</html>
