<?php
	class Message
	{
		var $SenderID;
		var $RecieverID;
		var $MsgBody;
		var $MsgID;
		var $MDate;
		var $MTime;
		
		function Message($RID, $SID, $Body, $MID, $Mdate, $Mtime)
		{
			$this->SenderID = $SID;
			$this->RecieverID = $RID;
			$this->MsgBody = $Body;
			$this->MsgID = $MID;
			$this->MDate = $Mdate;
			$this->MTime = $Mtime;
		}
		
		function getSenderID()
		{
			return $this->SenderID;
		}
		
		function getRecieverID()
		{
			return $this->RecieverID;
		}
		
		function getMessageBody()
		{
			return $this->MsgBody;
		}
		
		function getMessageID()
		{
			return $this->MsgID;
		}
		
		function getMessageTiime()
		{
			return $this->MTime;
		}
		
		function getMessageDate()
		{
			return $this->MDate;
		}
	}
?>