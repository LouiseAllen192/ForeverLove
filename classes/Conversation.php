<?php
	class Conversation
	{
		var $Contents; //ArrayList of messages between two users
		var $SenderID;
		var $RecieverID;
		
		function Conversation($Messages, $SID, $RID)
		{
			$this->Contents = $Messages;
			$this->SenderID = $SID;
			$this->RecieverID = $RID;
		}
		
		function setConversation($Messages, $SID, $RID)
		{
			$this->Contents = $Messages;
			$this->SenderID = $SID;
			$this->RecieverID = $RID;
		}
		
		function getContents()
		{
			return $this->Contents;
		}
		
		function getSenderID()
		{
			return $this->SenderID;
		}
		
		function getRecieverID()
		{
			return $this->RecieverID;
		}
	}
?>