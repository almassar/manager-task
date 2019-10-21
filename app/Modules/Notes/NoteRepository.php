<?php

namespace App\Modules\Notes;

use App\Modules\Repositories\Repository;

class NoteRepository extends Repository
{
	public function model()
	{
		return Note::class;
	}

}