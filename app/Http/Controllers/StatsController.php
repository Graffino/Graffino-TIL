<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Post;

use Illuminate\Http\Request;

class StatsController extends Controller
{
  public function index() {
    $postsForDaysSQL = DB::select("with posts as (
       select date((created_at at time zone 'America/New_York')::timestamptz) as post_date
        from posts
        where created_at is not null
      )
      select dates_table.date, count(posts.post_date) from (
        select (generate_series(now()::date - '29 day'::interval, now()::date, '1 day'::interval))::date as date
      ) as dates_table
      left outer join posts
      on posts.post_date=dates_table.date
      group by dates_table.date
      order by dates_table.date");
    $postsForDays = Post::hydrate($postsForDaysSQL);

    $data = [
      'postsForDays' => $postsForDays,
      'maxCount' => $postsForDays->map(function ($entry) {
        return $entry->count;
      })->max(),
    ];

    return view('stats.all', $data);
  }
}
