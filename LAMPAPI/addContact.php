<?php

	$inData = getRequestInfo();

	// connect to db
	$conn = new mysqli("localhost", "Group25", "25!!Poos", "KnightBook");
	if ($conn->connect_error)
	{
		returnWithError($conn->connect_error);
	}
	else
	{
		$sql = "INSERT INTO Contacts (FirstName, LastName, Email, Phone) VALUES ('". $inData["firstName"] . "','" . $inData["lastName"] . "','" . $inData["email"] . "','" . $inData["phone"] . "')";
		if ($conn->query($sql) === FALSE)
		{
			returnWithError("Could Not Insert Contact");
		}
		$conn->close();
	}

	function returnWithError($err)
	{
		$retValue = '{"id":0,"firstName":"","lastName":"","error":"' . $err . '"}';
		sendResultInfoAsJson( $retValue );
	}

	function getRequestInfo()
	{
		return json_decode(file_get_contents('php://input'), true);
	}

	function sendResultInfoAsJson($obj)
	{
		header('Content-type: application/json');
		echo $obj;
	}

?>