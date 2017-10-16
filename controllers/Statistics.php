<?php namespace Indikator\News\Controllers;

use Backend\Classes\Controller;
use BackendMenu;
use Indikator\News\Models\Logs;
use Indikator\News\Models\Posts;
use Indikator\News\Models\Settings;
use Db;
use Backend;

class Statistics extends Controller
{
    public $requiredPermissions = ['indikator.news.statistics'];

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Indikator.News', 'news', 'statistics');
    }

    public function index()
    {
        $this->prepareLog();
        $this->prepareGraphs();

        $this->pageTitle = 'indikator.news::lang.menu.statistics';
    }

    protected function prepareGraphs()
    {
        // Permissions

        $this->vars['posts'] = Settings::get('statistic_show_posts', true);
        $this->vars['mails'] = Settings::get('statistic_show_mails', true);

        // Graphs

        $this->vars['thisYear'] = $this->vars['lastYear'] = [0 => 0, 1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0, 7 => 0, 8 => 0, 9 => 0, 10 => 0, 11 => 0, 12 => 0];
        $this->vars['now'] = $now = date('Y');

        $news = Posts::get();
        $this->vars['view'] = Posts::sum('statistics');

        foreach ($news as $item) {
            $year = substr($item->published_at, 0, 4);
            if ($year == $now) {
                $this->vars['thisYear'][(int)substr($item->published_at, 5, 2)]++;
            }
            else if ($year == $now - 1) {
                $this->vars['lastYear'][(int)substr($item->published_at, 5, 2)]++;
                $this->vars['lastYear'][0]++;
            }
        }

        // TOP 20

        $amount = Posts::count();
        if ($amount > 20) {
            $amount = 20;
        }

        $news = Posts::orderBy('statistics', 'desc')->take($amount)->get();
        $top = '';
        $index = 1;

        foreach ($news as $item) {
            $top .= '
                <div class="col-md-1 col-sm-1">
                    '.$index.'.
                </div>
                <div class="col-md-9 col-sm-9">
                    <a href="'.Backend::url('indikator/news/posts/update/'.$item->id).'">'.$item->title.'</a>
                </div>
                <div class="col-md-2 col-sm-2 text-right">
                    '.number_format($item->statistics, 0, '.', ' ').'
                </div>
                <div class="clearfix"></div>
            ';

            if ($index % 5 == 0) {
                $top .= '<br>';
            }

            $index++;
        }

        $this->vars['top'] = $top;

        // Posts length

        $news = Posts::get();
        $posts = [];

        foreach ($news as $item) {
            $posts[$item->id] = strlen(strip_tags($item->introductory.$item->content));
        }

        // Longest posts

        if (Settings::get('statistic_show_longest_posts', true)) {
            arsort($posts);
            $longest = '';
            $index = 1;

            foreach ($posts as $id => $length) {
                $item = Posts::whereId($id)->first();

                $longest .= '
                    <div class="col-md-1 col-sm-1">
                        '.$index.'.
                    </div>
                    <div class="col-md-9 col-sm-9">
                        <a href="'.Backend::url('indikator/news/posts/update/'.$item->id).'">'.$item->title.'</a>
                    </div>
                    <div class="col-md-2 col-sm-2 text-right">
                        '.number_format($length, 0, '.', ' ').'
                    </div>
                    <div class="clearfix"></div>
                ';

                if ($index == 10) {
                    break;
                }

                $index++;
            }

            $this->vars['longest'] = $longest;
        }

        // Shortest posts

        if (Settings::get('statistic_show_shortest_posts', true)) {
            asort($posts);
            $shortest = '';
            $index = 1;

            foreach ($posts as $id => $length) {
                $item = Posts::whereId($id)->first();

                $shortest .= '
                    <div class="col-md-1 col-sm-1">
                        '.$index.'.
                    </div>
                    <div class="col-md-9 col-sm-9">
                        <a href="'.Backend::url('indikator/news/posts/update/'.$item->id).'">'.$item->title.'</a>
                    </div>
                    <div class="col-md-2 col-sm-2 text-right">
                        '.number_format($length, 0, '.', ' ').'
                    </div>
                    <div class="clearfix"></div>
                ';

                if ($index == 10) {
                    break;
                }

                $index++;
            }

            $this->vars['shortest'] = $shortest;
        }
    }

    protected function prepareLog()
    {
        $log['queued'] = Db::table('indikator_news_newsletter_logs')
            ->select(Db::raw("count(id) as c, YEAR(queued_at) as y, MONTH(queued_at) as m"))
            ->groupBy(Db::raw("YEAR(queued_at), MONTH(queued_at)"))
            ->orderBy('y')
            ->orderBy('m')
            ->get();

        $log['send'] = Db::table('indikator_news_newsletter_logs')
            ->select(Db::raw("count(id) as c, YEAR(send_at) as y, MONTH(send_at) as m"))
            ->whereNotNull('send_at')
            ->groupBy(Db::raw("YEAR(send_at), MONTH(send_at)"))
            ->orderBy('y')
            ->orderBy('m')
            ->get();

        $log['viewed'] = Db::table('indikator_news_newsletter_logs')
            ->select(Db::raw("count(id) as c, YEAR(viewed_at) as y, MONTH(viewed_at) as m"))
            ->whereNotNull('viewed_at')
            ->groupBy(Db::raw("YEAR(viewed_at), MONTH(viewed_at)"))
            ->orderBy('y')
            ->orderBy('m')
            ->get();

        $log['clicked'] = Db::table('indikator_news_newsletter_logs')
            ->select(Db::raw("count(id) as c, YEAR(clicked_at) as y, MONTH(clicked_at) as m"))
            ->whereNotNull('clicked_at')
            ->groupBy(Db::raw("YEAR(clicked_at), MONTH(clicked_at)"))
            ->orderBy('y')
            ->orderBy('m')
            ->get();

        $result = [];

        foreach ($log as $name => $l) {
            foreach ($l as $entry) {
                $result[$entry->y][$entry->m][$name] = $entry->c;
            }
        }

        foreach ($result as $year => $entry) {
            for ($i = 1; $i < 13; $i++) {
                foreach ($log as $name => $l) {
                    if (!isset($result[$year][$i][$name])) {
                        $result[$year][$i][$name] = 0;
                    }
                }
            }
        }

        $result = array_sort_recursive($result);

        $this->vars['logResults'] = $result;
        $this->vars['logResultsFields'] = array_keys($log);
        $this->vars['logResultsFieldsTrans'] = array_map(function($t) {
            return trans('indikator.news::lang.stat.'.$t);
        }, array_keys($log));
    }
}
