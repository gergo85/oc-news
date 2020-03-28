<?php namespace Indikator\News\Controllers;

use Backend\Classes\Controller;
use BackendMenu;
use Backend;
use Indikator\News\Models\Logs;
use Indikator\News\Models\Posts;
use Indikator\News\Models\Settings;
use Db;

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

        $this->addCss('/plugins/indikator/news/assets/css/statistics.css');
    }

    protected function prepareGraphs()
    {
        // Permissions

        $this->vars['posts'] = Settings::get('statistic_show_posts', true);
        $this->vars['mails'] = Settings::get('statistic_show_mails', true);

        // Graphs

        $this->vars['thisYear'] = $this->vars['lastYear'] = array_fill(0, 13, 0);
        $this->vars['now']  = date('Y');
        $this->vars['view'] = Posts::sum('statistics');
        $this->vars['top']  = '';

        $allNews = Posts::get();
        $amount  = Posts::count();

        foreach ($allNews as $item) {
            $year = substr($item->published_at, 0, 4);
            if ($year == $this->vars['now']) {
                $this->vars['thisYear'][(int)substr($item->published_at, 5, 2)]++;
            }
            else if ($year == $this->vars['now'] - 1) {
                $this->vars['lastYear'][(int)substr($item->published_at, 5, 2)]++;
                $this->vars['lastYear'][0]++;
            }
        }

        // TOP 20

        if ($amount > 20) {
            $amount = 20;
        }

        $news = Posts::orderBy('statistics', 'desc')->take($amount)->get();
        $index = 1;

        foreach ($news as $item) {
            $this->vars['top'] .= '
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
                $this->vars['top'] .= '<br>';
            }

            $index++;
        }

        // Posts length

        $posts = [];
        foreach ($allNews as $item) {
            $posts[$item->id] = strlen(trim(preg_replace('/\s+/', ' ', strip_tags($item->introductory.$item->content))));
        }

        // Longest posts

        if (Settings::get('statistic_show_longest_posts', true)) {
            arsort($posts);

            $this->vars['longest'] = '';
            $index = 1;

            foreach ($posts as $id => $length) {
                $item = Posts::whereId($id)->first();

                $this->vars['longest'] .= '
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
        }

        // Shortest posts

        if (Settings::get('statistic_show_shortest_posts', true)) {
            asort($posts);

            $this->vars['shortest'] = '';
            $index = 1;

            foreach ($posts as $id => $length) {
                $item = Posts::whereId($id)->first();

                $this->vars['shortest'] .= '
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
        }
    }

    protected function prepareLog()
    {
        $log['queued'] = Db::table('indikator_news_newsletter_logs')
            ->select(Db::raw("count(id) as c, extract(year from queued_at) as y, extract(month from queued_at) as m"))
            ->groupBy(Db::raw("extract(year from queued_at), extract(month from queued_at)"))
            ->orderBy('y')
            ->orderBy('m')
            ->get();

        $log['send'] = Db::table('indikator_news_newsletter_logs')
            ->select(Db::raw("count(id) as c, extract(year from send_at) as y, extract(month from send_at) as m"))
            ->whereNotNull('send_at')
            ->groupBy(Db::raw("extract(year from send_at), extract(month from send_at)"))
            ->orderBy('y')
            ->orderBy('m')
            ->get();

        $log['viewed'] = Db::table('indikator_news_newsletter_logs')
            ->select(Db::raw("count(id) as c, extract(year from viewed_at) as y, extract(month from viewed_at) as m"))
            ->whereNotNull('viewed_at')
            ->groupBy(Db::raw("extract(year from viewed_at), extract(month from viewed_at)"))
            ->orderBy('y')
            ->orderBy('m')
            ->get();

        $log['clicked'] = Db::table('indikator_news_newsletter_logs')
            ->select(Db::raw("count(id) as c, extract(year from clicked_at) as y, extract(month from clicked_at) as m"))
            ->whereNotNull('clicked_at')
            ->groupBy(Db::raw("extract(year from clicked_at), extract(month from clicked_at)"))
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
