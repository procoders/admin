<?php namespace SleepingOwl\Admin\Controllers;

use App;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Lang;

class LangController extends Controller
{

    const MAX_AGE = 31536000;

	public function getAll()
	{
		$lang = Lang::get('admin::lang');
		if ($lang == 'admin::lang')
		{
			$lang = Lang::get('admin::lang', [], 'en');
		}
		$content = 'window.admin={}; window.admin.locale="' . App::getLocale() . '"; window.admin.lang=' . json_encode($lang) . ';';

		$response = new Response($content, 200, [
			'Content-Type' => 'text/javascript',
		]);

		return $this->cacheResponse($response);
	}

	/**
	 * Cache the response 1 year (31536000 sec)
	 * @param Response $response
	 * @return \Illuminate\Http\Response
	 */
	protected function cacheResponse(Response $response)
	{
		$response->setSharedMaxAge(self::MAX_AGE);
		$response->setMaxAge(self::MAX_AGE);
		$response->setExpires(new \DateTime('+1 year'));

		return $response;
	}
} 