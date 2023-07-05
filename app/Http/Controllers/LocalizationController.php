<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;

/**
 * To handle language changes
 *
 * @author Swam Htet Aung
 *
 * @create date 05-07-2023
 *
 */
class LocalizationController extends Controller
{
    /**
     * Changing language
     * @author Swam Htet Aung
     *
     * @create date 05-07-2023
     * @param $lang
     * @return void
     */
    public function changeLang($lang)
    {
        $allowedLanguages = ['en','mm'];

        if(!in_array($lang, $allowedLanguages)){
            return redirect()->back();
        }

        App::setLocale($lang);
        session()->put('locale',$lang);
        return redirect()->back();
    }
}
