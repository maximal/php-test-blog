<?php
/**
 *
 * @author MaximAL
 * @since 2018-03-15
 * @date 2018-03-15
 * @time 12:56
 * @copyright © MaximAL, Sijeko 2018
 */

namespace app\system;

/**
 * Веб-приложение
 *
 * @property array $config Конфигурация
 * @property string $webDir Путь к веб-папке
 * @property string $baseDir Путь к папке приложения
 * @property Connection $db Подключение к БД
 *
 * @package app\system
 */
class App
{
	public $db;

	protected $config;
	protected $webDir;
	protected $baseDir;
	protected $baseUrl;

	public function __construct($config)
	{
		$this->config = $config;
		$this->webDir = __DIR__;
		$this->baseDir = realpath(__DIR__ . '/..');
		$this->baseUrl = 'http' . ($_SERVER['REQUEST_SCHEME'] === 'https' ? 's' : '') . '://' . $_SERVER['HTTP_HOST'];
	}

	public function run()
	{
		try {
			$this->db = new Connection($this->config['db']);
		} catch (\Exception $exception) {
			return Http::status(500, 'Database Connection Failed: ' . $exception->getMessage());
		}

		$urlConfig = isset($this->config['url']) ? $this->config['url'] : null;
		if ($urlConfig === null) {
			return Http::status(404, 'URL Config Not Found');
		}
		$urlRules = isset($urlConfig['rules']) ? $urlConfig['rules'] : null;
		if (!is_array($urlRules)) {
			return Http::status(404, 'URL Rules Not Found');
		}

		$url = trim($_SERVER['REQUEST_URI'], '/');
		foreach ($urlRules as $rule => $route) {
			if ($rule === '') {
				if ($url === '') {
					return $this->runControllerAction($route);
				}
				continue;
			}

			$match = null;
			if (preg_match('#^' . $rule . '$#ui', $url, $match)) {
				array_shift($match);
				return $this->runControllerAction($route, $match);
			}
		}

		return Http::status(404, 'Not Found');
	}

	public function runControllerAction($route, $params = [])
	{
		// $parts[0] — контроллер
		// $parts[1] — экшн
		$parts = explode('/', $route);
		$controllerClass = mb_convert_case($parts[0], MB_CASE_TITLE);
		$controllerFilename = $this->baseDir . DIRECTORY_SEPARATOR .
			'controllers' . DIRECTORY_SEPARATOR . $controllerClass . '.php';

		if (!file_exists($controllerFilename)) {
			return Http::status(404, 'Controller File Not Found');
		}

		// Подключаем файл контроллера
		require_once $controllerFilename;
		$fullControllerName = '\\app\\controllers\\' . $controllerClass;
		if (!class_exists($fullControllerName)) {
			return Http::status(404, 'Controller Class `' . $controllerClass . '` Not Found');
		}

		// Экшн по умолчанию — index
		// Метод по умолчанию — actionIndex
		$controller = new $fullControllerName($this);
		$action = count($parts) > 1 ?
			('action' . mb_convert_case($parts[1], MB_CASE_TITLE)) :
			'actionIndex';
		if (!method_exists($controller, $action)) {
			return Http::status(404, 'Controller Action `' . $controllerClass . '::' . $action . '` Not Found');
		}

		// Получаем контент
		$content = call_user_func_array([$controller, $action], $params);

		if (is_int($content)) {
			return Http::status($content, '');
		}

		if (!is_string($content)) {
			return Http::status(500, 'Controller Server Error');
		}

		echo $content;
		return 200;
	}

	/**
	 * Получить базовый УРЛ веб-приложения
	 * @return string Возвращает строку с базовым УРЛом веб-приложения
	 */
	public function getBaseUrl()
	{
		return $this->baseUrl;
	}
}
