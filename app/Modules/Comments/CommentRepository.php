<?php

namespace App\Modules\Comments;

use App\Modules\Repositories\Repository;

class CommentRepository extends Repository
{
	public function model()
	{
		return Comment::class;
	}

}