<?php
namespace Dsu\Traits;

trait Coursify
{
	private $user =null;
	private $user_documents = null;

	public function setuser()
	{
		if(is_null($this->user))
			$this->user = \Dsu\Models\User::with('documents')->findOrFail(\Auth::id());
		return $this;
	}

	public function userDocuments()
	{
		if(is_null($this->user_documents))
		{
			$this->user_documents = $this->documents->pluck('slug')->toArray();

		}
		return $this;

	}

	public function hasDocument($document)
	{
		return in_array($document,$this->user_documents);
	}
}

?>