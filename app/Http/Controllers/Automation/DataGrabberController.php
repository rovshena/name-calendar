<?php

namespace App\Http\Controllers\Automation;

use App\Http\Controllers\Controller;
use App\Jobs\GrabData;
use App\Models\Grabber;
use Goutte\Client;
use Illuminate\Http\Request;
use Symfony\Component\HttpClient\HttpClient;

class DataGrabberController extends Controller
{
    public function __invoke(Request $request)
    {
        // dispatch(new GrabData());
        $this->addReligion2("/iudeyskie-imena.html", "Jewish");
    }

    private function setGoutte()
    {
        $goutteClient = new Client(HttpClient::create(array(
            'headers' => array(
                'user-agent' => 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Mobile Safari/537.36'
            ),
        )));
        $goutteClient->setServerParameter('HTTP_USER_AGENT', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Mobile Safari/537.36');

        return $goutteClient;
    }

    public function clearNations()
    {
        foreach (Grabber::all() as $data) {
            $data->nationality = "";
            $data->save();
        }
    }

    public function namesToJson()
    {
        foreach (Grabber::all() as $data) {
            $tempName = $this->cyrillicToLatin($data->name);
            $data->name = json_encode(["main" => $tempName], JSON_UNESCAPED_UNICODE);
            // $tempName = json_decode($data->name, true);
            // $data->name = $tempName["main"];
            $data->save();
        }
    }

    public function nameFilterTwo($str)
    {
        if (strpos($str, "-")) {
            $tempArr = explode("-", $str);
        } else if (strpos($str, "—")) {
            $tempArr = explode("—", $str);
        } else if (strpos($str, "–")) {
            $tempArr = explode("–", $str);
        } else {
            return $str;
        }
        echo "str:" . $str . "<br>";
        return trim($tempArr[1]);
    }

    public function cyrillicToLatin($str)
    {
        $cyr = ['а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я', 'А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', 'Є'];
        $lat = ['a', 'b', 'v', 'g', 'd', 'e', 'io', 'zh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'ts', 'ch', 'sh', 'sh', '', 'y', '', 'e', 'yu', 'ya', 'A', 'B', 'V', 'G', 'D', 'E', 'Io', 'Zh', 'Z', 'I', 'Y', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'H', 'Ts', 'Ch', 'Sh', 'Sh', '', 'Y', '', 'E', 'Yu', 'Ya', 'E'];
        return str_replace($cyr, $lat, $str);
    }

    public function addingNames()
    {
        $goutteClient = new Client(HttpClient::create(array(
            'headers' => array(
                'user-agent' => 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Mobile Safari/537.36'
            ),
        )));
        $goutteClient->setServerParameter('HTTP_USER_AGENT', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Mobile Safari/537.36');

        // $goutteClient = new Client(HttpClient::create(['timeout' => 60]));
        $crawler = $goutteClient->request('GET', 'https://kakzovut.ru' . '/woman.html');
        sleep(rand(10, 20));
        $crawler->filter('.nameslist a')->each(function ($node) {
            $namePage = new Client(HttpClient::create(array(
                'headers' => array(
                    'user-agent' => 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Mobile Safari/537.36'
                ),
            )));
            $namePage->setServerParameter('HTTP_USER_AGENT', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Mobile Safari/537.36');

            $name = $node->text();
            $link = $node->attr('href');
            $gender = 'female';
            $nationality = 'need_to_add';
            $letter = 'xxx';
            $counter = 0;
            if (Grabber::where('link', $link)->get()->count() < 1) {
                $counter++;
                if ($counter % 5 == 0) {
                    sleep(rand(140, 200));
                } else {
                    sleep(rand(11, 27));
                }

                $crawlerName = $namePage->request('GET', 'https://kakzovut.ru' . $node->attr("href"));
                if ($crawlerName->filter("article[itemprop='articleBody']")->count() > 0) {
                    $articleBody = $crawlerName->filter("article[itemprop='articleBody']")->html();
                    Grabber::create(compact('name', 'link', 'articleBody', 'gender', 'nationality', 'letter'));
                }
                echo "<strong style='color: green;'>adding name: " . $name . "</strong><br>";
            } else {
                echo "<strong style='color: red;'>already added: " . $name . "</strong><br>";
            }
        });
    }

    public function addNewNameVariant($link, $newName, $key)
    {
        $data = Grabber::where("link", $link)->firstOrFail();
        $nameArr = json_decode($data->name, true);

        $nameArr[$key] = $newName;
        $data->name = json_encode($nameArr);

        $data->save();
    }

    public function addNation1($link, $nationality)
    {
        $this->nationTemp = $nationality;
        $goutteClient = $this->setGoutte();

        $crawler = $goutteClient->request('GET', 'https://kakzovut.ru' . $link);
        // sleep(rand(10, 20));
        $crawler->filter('.nameslist')->each(function ($node) {
            // dump($node);
            if ($node->filter("a")->count() == 0) {
                // $tempName = $this->nameFilterTwo($node->html());
                $tempName = $this->cyrillicToLatin($node->text());
                $name = json_encode(["main" => $tempName, $this->nationTemp => $tempName], JSON_UNESCAPED_UNICODE);
                $link = "-";
                $articleBody = "-";
                $gender = "-";
                $nationality = json_encode([$this->nationTemp]);
                $letter = "xxx";
                if (Grabber::where('name', $name)->get()->count() < 1) {
                    Grabber::create(compact('name', 'link', 'articleBody', 'gender', 'nationality', 'letter'));
                } else {
                    $data = Grabber::where("name", $name)->firstOrFail();
                    $data->name = $name;
                    $data->nationality = $nationality;
                    $data->save();
                }
            } else {
                $node = $node->filter("a");
                $link = $node->attr('href');
                $name = $this->cyrillicToLatin($node->text());
                echo "name: " . $name . "<br>";
                if (Grabber::where('link', $link)->get()->count() >= 1) {
                    $data = Grabber::where('link', $link)->first();

                    $tempNatArr = json_decode($data->nationality);
                    if ($tempNatArr == null || !in_array($this->nationTemp, $tempNatArr)) {
                        $tempNatArr[] = $this->nationTemp;
                    }

                    // $tempName = $this->nameFilterTwo($node->text());
                    $tempName = $name;
                    $tempNameArr = json_decode($data->name, true);
                    $tempNameArr[$this->nationTemp] = $tempName;
                    $name = json_encode($tempNameArr, JSON_UNESCAPED_UNICODE);

                    $data->name = $name;
                    $data->nationality = json_encode($tempNatArr);
                    $data->save();
                } else {
                    echo "not added:" . $name . "br";
                }
            }
            // sleep(rand(10, 20));
        });
    }

    public function addNation2($link, $nationality)
    {
        $this->nationTemp = $nationality;
        $goutteClient = $this->setGoutte();

        $crawler = $goutteClient->request('GET', 'https://kakzovut.ru' . $link);
        $crawler->filter('table td[valign="top"] a')->each(function ($node) {
            $link = $node->attr('href');
            $name = $this->cyrillicToLatin($node->text());
            echo $name . "<br>";
            if (Grabber::where('link', $link)->get()->count() >= 1) {
                $data = Grabber::where('link', $link)->first();

                $tempNatArr = json_decode($data->nationality);
                if ($tempNatArr == null || !in_array($this->nationTemp, $tempNatArr)) {
                    $tempNatArr[] = $this->nationTemp;
                }

                $tempNameArr = json_decode($data->name, true);
                $tempNameArr[$this->nationTemp] = $name;
                $name = json_encode($tempNameArr, JSON_UNESCAPED_UNICODE);

                $data->name = $name;
                $data->nationality = json_encode($tempNatArr);
                $data->save();
            } else {
                echo "not added:" . $name . "br";
            }
        });
    }

    public function addNation3($link, $nationality)
    {
        $goutteClient = $this->setGoutte();
        $this->nationTemp = $nationality;

        $crawler = $goutteClient->request('GET', 'https://kakzovut.ru' . $link);
        $crawler->filter('.nameslistxl')->each(function ($node) {
            if ($node->filter("a")->count() == 0) {
                $tempName = $this->cyrillicToLatin($this->nameFilterTwo($node->html()));
                $name = json_encode(["main" => $tempName, $this->nationTemp => $tempName], JSON_UNESCAPED_UNICODE);
                $link = "-";
                $articleBody = "-";
                $gender = "-";
                $nationality = json_encode([$this->nationTemp]);
                $letter = "xxx";
                if (Grabber::where('name', $name)->get()->count() < 1) {
                    Grabber::create(compact('name', 'link', 'articleBody', 'gender', 'nationality', 'letter'));
                } else {
                    $data = Grabber::where("name", $name)->firstOrFail();
                    $data->name = $name;
                    $data->nationality = $nationality;
                    $data->save();
                }
            } else {
                $el = $node->filter("a");
                $link = $el->attr('href');
                $name = $el->text();
                echo "name: " . $name . "<br>";
                if (Grabber::where('link', $link)->get()->count() >= 1) {
                    $data = Grabber::where('link', $link)->first();

                    $tempNatArr = json_decode($data->nationality);
                    if ($tempNatArr == null || !in_array($this->nationTemp, $tempNatArr)) {
                        $tempNatArr[] = $this->nationTemp;
                    }

                    $tempName = $this->cyrillicToLatin($this->nameFilterTwo($node->text()));
                    $tempNameArr = json_decode($data->name, true);
                    $tempNameArr[$this->nationTemp] = $tempName;
                    $name = json_encode($tempNameArr, JSON_UNESCAPED_UNICODE);

                    $data->name = $name;
                    $data->nationality = json_encode($tempNatArr);
                    $data->save();
                } else {
                    echo "not added:" . $name . "<br>";
                }
            }
            // sleep(rand(10, 20));
        });
    }

    public function addReligion1($link, $religion)
    {
        $this->religion = $religion;
        $goutteClient = $this->setGoutte();

        $crawler = $goutteClient->request('GET', 'https://kakzovut.ru' . $link);
        $crawler->filter('.nameslist')->each(function ($node) {
            $node = $node->filter("a");
            $link = $node->attr('href');
            $name = $this->cyrillicToLatin($node->text());
            echo "name: " . $name . "<br>";
            if (Grabber::where('link', $link)->get()->count() >= 1) {
                $data = Grabber::where('link', $link)->first();

                $tempRelArr = json_decode($data->religion);
                if ($tempRelArr == null || !in_array($this->religion, $tempRelArr)) {
                    $tempRelArr[] = $this->religion;
                }

                // $tempName = $this->nameFilterTwo($node->text());
                $tempName = $name;
                $tempNameArr = json_decode($data->name, true);
                $tempNameArr[$this->religion] = $tempName;
                $name = json_encode($tempNameArr, JSON_UNESCAPED_UNICODE);

                $data->name = $name;
                $data->religion = json_encode($tempRelArr);
                $data->save();
            } else {
                echo "not added:" . $name . "br";
            }
        });
    }

    public function addReligion2($link, $religion)
    {
        $this->religion = $religion;
        $goutteClient = $this->setGoutte();

        $crawler = $goutteClient->request('GET', 'https://kakzovut.ru' . $link);
        $crawler->filter('table td[valign="top"] a')->each(function ($node) {
            $link = $node->attr('href');
            $name = $this->cyrillicToLatin($node->text());
            echo "name: " . $name . "<br>";
            if (Grabber::where('link', $link)->get()->count() >= 1) {
                $data = Grabber::where('link', $link)->first();

                $tempRelArr = json_decode($data->religion);
                if ($tempRelArr == null || !in_array($this->religion, $tempRelArr)) {
                    $tempRelArr[] = $this->religion;
                }

                $tempNameArr = json_decode($data->name, true);
                $tempNameArr[$this->religion] = $name;
                $name = json_encode($tempNameArr, JSON_UNESCAPED_UNICODE);

                $data->name = $name;
                $data->religion = json_encode($tempRelArr);
                $data->save();
            } else {
                echo "not added:" . $name . "br";
            }
        });
    }
}
