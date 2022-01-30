<?php

namespace App\Jobs;

use App\Models\Grabber;
use App\Models\Translation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Stichoza\GoogleTranslate\GoogleTranslate;

class TranslateData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->translate();
    }

    public function translate()
    {
        $totalCount = 0;
        $tr = new GoogleTranslate('en', 'ru', ['verify' => false]);

        foreach (Grabber::all() as $data) {
            $grabber_id = $data->id;
            if (Translation::where('grabber_id', $grabber_id)->get()->count() == 0) {
                $articleBody = $data->articleBody;

                $htmlTemp = preg_replace('#<ins(.*?)ins>#is', '', $articleBody);
                $htmlTemp = preg_replace('#<!--(.*?)-->#is', '', $htmlTemp);
                $htmlTemp = preg_replace('#<script(.*?)script>#is', '', $htmlTemp);

                $translatedHtml = $textTemp = "";
                while (1) {
                    if (strlen($htmlTemp) <= 4000) {
                        try {
                            sleep(80);
                            echo "\n********adding final translation********\n";
                            echo "length textTemp:" . strlen($textTemp) . "\n";
                            echo "length htmlTemp:" . strlen($htmlTemp) . "\n";
                            $translatedHtml .= $tr->translate($textTemp);
                            $translatedHtml .= $tr->translate($htmlTemp);
                            $totalCount += 2;
                            echo $totalCount . "\n";
                            break;
                        } catch (\Throwable $throwable) {
                            if ($throwable instanceof \ErrorException || $throwable instanceof \UnexpectedValueException) {
                                echo 'Error Message: ' . $throwable->getMessage();
                                sleep(600);
                            }
                        }
                    } else if (strlen($textTemp) > 3500) {
                        try {
                            sleep(40);
                            echo "length textTemp:" . strlen($textTemp) . "\n";
                            $translatedHtml .= $tr->translate($textTemp);
                            $textTemp = "";
                            $totalCount++;
                            echo $totalCount . "\n";
                        } catch (\Throwable $throwable) {
                            if ($throwable instanceof \ErrorException || $throwable instanceof \UnexpectedValueException) {
                                echo 'Error Message: ' . $throwable->getMessage();
                                sleep(600);
                            }
                        }
                    } else {
                        if (strlen($textTemp . substr($htmlTemp, 0, strpos($htmlTemp, ".")) . ".") > 4500 && strpos($htmlTemp, "<p>") && strlen($textTemp . substr($htmlTemp, 0, strpos($htmlTemp, "<p>")) . "<p>") <= 4500) {
                            $textTemp .= substr($htmlTemp, 0, strpos($htmlTemp, "<p>")) . "<p>";
                            $htmlTemp = substr($htmlTemp, strpos($htmlTemp, "<p>") + 3);
                        } else if (strlen($textTemp . substr($htmlTemp, 0, strpos($htmlTemp, ".")) . ".") > 4500 && strpos($htmlTemp, "<li>") && strlen($textTemp . substr($htmlTemp, 0, strpos($htmlTemp, "<li>")) . "<li>") <= 4500) {
                            $textTemp .= substr($htmlTemp, 0, strpos($htmlTemp, "<li>")) . "<li>";
                            $htmlTemp = substr($htmlTemp, strpos($htmlTemp, "<li>") + 4);
                        } else {
                            $textTemp .= substr($htmlTemp, 0, strpos($htmlTemp, ".")) . ".";
                            $htmlTemp = substr($htmlTemp, strpos($htmlTemp, ".") + 1);
                        }

                        // echo "adding text textTemp " . strlen($textTemp) . "\n";
                    }
                }

                $name = $data->name;
                $link = $data->link;
                $articleBody = $translatedHtml;
                $gender = $data->gender;
                $nationality = $data->nationality;
                $religion = $data->religion;
                $letter = json_decode($data->name, true)['main'][0];
                Translation::create(compact('name', 'link', 'articleBody', 'gender', 'nationality', 'letter', 'grabber_id', 'religion'));
            }
        }
    }
}
