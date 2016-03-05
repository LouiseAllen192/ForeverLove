<?php
	class MessageInbox
	{
		var $Conversations;
		var $UserID;
		function MessageInbox($ConversationsList, $UID)
		{
			$this->Conversations = $ConversationsList;
			$this->UserID = $UID;
		}
		
		function getConversations()
		{
			return $this->Conversations;
		}
		
		function getUserID()
		{
			return $this->UserID;
		}
	}
?>