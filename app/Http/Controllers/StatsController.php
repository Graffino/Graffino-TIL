<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Post;

use Illuminate\Http\Request;

class StatsController extends Controller
{

    public function index()
    {
        $postsForDaysSQL = DB::select(
            "with posts as (
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
      order by dates_table.date"
        );
        $postsForDays    = Post::hydrate($postsForDaysSQL);

        $postsByChannelsCount = DB::table('posts')
        ->join('channels', 'posts.channel_id', '=', 'channels.id')
        ->groupBy('channels.name')
        ->orderByRaw('count(posts.id) DESC')
        ->select(DB::raw('count(posts.id), channels.name'))
        ->get();

        $postsByDevelopersCount = DB::table('posts')
        ->join('developers', 'posts.developer_id', '=', 'developers.id')
        ->groupBy('developers.username')
        ->orderByRaw('count(posts.id) DESC')
        ->select(DB::raw('count(posts.id), developers.username'))
        ->get();

        $mostLikedPosts = DB::table('posts')
        ->join('channels', 'posts.channel_id', '=', 'channels.id')
        ->orderBy('posts.likes', 'desc')
        ->orderBy('posts.created_at', 'desc')
        ->limit(10)
        ->select('posts.title', 'posts.likes', 'posts.slug', 'channels.name as channel')
        ->get();

        $postsWithAgeInHours = DB::table('posts')
        ->whereNotNull('created_at')
        ->select(
            DB::raw(
                '
      posts.id as id,
      posts.likes as likes,
      greatest(extract(epoch from(current_timestamp - posts.created_at)) / 3600, 0.1) as hours_age
    '
            )
        )
        ->toSql();

        $hottestPosts = DB::table(DB::raw('(' . $postsWithAgeInHours . ') as sub'))
        ->join('posts', 'posts.id', '=', 'sub.id')
        ->join('channels', 'channels.id', '=', 'sub.id')
        ->orderByRaw('5 DESC')
        ->select(
            DB::raw(
                '
        posts.title,
        sub.likes,
        posts.slug,
        channels.name as channel,
        sub.likes / (sub.hours_age ^ 0.8) as hottness
      '
            )
        )
        ->limit(10)
        ->get();

        $developersCount = DB::table('developers')->count();
        $channelsCount   = DB::table('channels')->count();
        $postsCount      = DB::table('posts')->count();

        $data = [
            'postsForDays'    => $postsForDays,
            'maxCount'        => $postsForDays->map(
                function ($entry) {
                    return ( $entry->count + 1 );
                }
            )->max(),
            'postsCount'      => $postsCount,
            'developers'      => $postsByDevelopersCount,
            'developersCount' => $developersCount,
            'channels'        => $postsByChannelsCount,
            'channelsCount'   => $channelsCount,
            'mostLikedPosts'  => $mostLikedPosts,
            'hottestPosts'    => $hottestPosts,
        ];

        return view('stats.all', $data);
    }
}
