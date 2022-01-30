<?php

namespace App\Jobs;

use App\Models\Grabber;
use Goutte\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Symfony\Component\HttpClient\HttpClient;

class GrabData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $host;
    private $counter;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->host = 'https://kakzovut.ru';
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->grab();
    }

    public function grab()
    {
        $goutteClient = new Client(HttpClient::create(array(
            'headers' => array(
                'user-agent' => 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Mobile Safari/537.36'
            ),
        )));
        $goutteClient->setServerParameter('HTTP_USER_AGENT', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Mobile Safari/537.36');
        // $goutteClient = new Client(HttpClient::create(['timeout' => 60]));
        $crawler = $goutteClient->request('GET', $this->host . '/man.html');
        sleep(rand(10, 20));
        $this->counter = 0;

        $crawler->filter('.nameslist a')->each(function ($node) {
            $namePage = new Client(HttpClient::create(array(
                'headers' => array(
                    'user-agent' => 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Mobile Safari/537.36'
                ),
            )));
            $namePage->setServerParameter('HTTP_USER_AGENT', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Mobile Safari/537.36');

            $name = $node->text();
            $link = $node->attr('href');
            $gender = 'male';
            $nationality = 'need_to_add';
            $letter = 'xxx';

            if (Grabber::where('link', $link)->get()->count() < 1) {
                $this->counter++;
                if ($this->counter % 5 == 0) {
                    sleep(rand(140, 200));
                } else {
                    sleep(rand(11, 27));
                }

                $crawlerName = $namePage->request('GET', $this->host . $node->attr("href"));
                if ($crawlerName->filter("article[itemprop='articleBody']")->count() > 0) {
                    $articleBody = $crawlerName->filter("article[itemprop='articleBody']")->html();
                    Grabber::create(compact('name', 'link', 'articleBody', 'gender', 'nationality', 'letter'));
                }
                echo "Adding name: " . $name . "\n";
            }
        });
    }
}
