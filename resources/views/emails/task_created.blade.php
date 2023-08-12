<html>
<head></head>
<body>

<h3> Hi {{ $team_member }}, </h3>
<br>

<p>
	New task is assigned to you.
	<br><br>

	<b>Details:</b>
	<br>
	Assigned by: {{ $manager_name }}
	<br>
	Project: {{ $project }}
	<br>
	Priority: @if($priority==1) High @elseif($priority==2) Medium @elseif($priority==3) Low @endif
	<br>
	Deadline: {{ $deadline }}
	<br><br>
</p>

<h3>Thank you</h3>

</body>
</html>