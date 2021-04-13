<?php

// require_once __DIR__ . '/autoloader.php';
//\spl_autoload_register('Autoloader::autoload');

$files = glob(__DIR__ . '/patterns/*.php');

$filesContent   = [];
$designPatterns = [];

foreach ($files as $key => $filePath) {
    $name = getFileName($filePath);
    $filesContent[$name] = file($filePath);
    require $filePath;
}

// lg($filesContent);

$designPatterns['adapter'] = renderPattern(function($args) use ($filesContent) {

    $result = adapterInit();

    $title = 'adapter';

    unset($filesContent[$title][0]);
    $fileContent = implode("", $filesContent[$title]);

    $description = "
         Привести нестандартный или неудобный интерфейс какого-то класса в интерфейс, совместимый с вашим кодом.
         Адаптер позволяет классам работать вместе стандартным образом, что обычно не получается из-за несовместимых интерфейсов,
         предоставляя для этого прослойку с интерфейсом, удобным для клиентов, самостоятельно используя оригинальный интерфейс.
    ";

    $clientCode = "";

    $replaceData = [$title, $description, $fileContent, $clientCode, $result];
    $section     = htmlSectionReplace($replaceData);
    echo $section;

}, []);


$designPatterns['decorator'] = renderPattern(function($args) use ($filesContent) {

    $result = decoratorInit();

    $title = 'decorator';

    unset($filesContent[$title][0]);
    $fileContent = implode("", $filesContent[$title]);

    $description = "
         Декоратор — это структурный паттерн, который позволяет добавлять объектам новые поведения на лету, помещая их в объекты-обёртки.
         Декоратор позволяет оборачивать объекты бесчисленное количество раз благодаря тому, что и обёртки,
         и реальные оборачиваемые объекты имеют общий интерфейс.
    ";

    $clientCode = "";

    $replaceData = [$title, $description, $fileContent, $clientCode, $result];
    $section     = htmlSectionReplace($replaceData);
    echo $section;

}, []);


$designPatterns['command'] = renderPattern(function($args) use ($filesContent) {

    $result = commandInit();

    $title = 'command';

    unset($filesContent[$title][0]);
    $fileContent = implode("", $filesContent[$title]);

    $description = "
        Команда (Command) относится к классу поведенческих паттернов. Команда представляет собой некоторое действие и его параметры. Суть паттерна в том, чтобы отделить инициатора и получателя команды.
        Структура довольно простая. Dispatcher посылает сообщение (команду), при этом он не знает, кто эту команду получит. Это сообщение проходит через ConcreteCommand и попадает в Receiver. 
        При этом Receiver не знает, от кого это сообщение пришло. Получается, что в этой диаграмме никто не обладает полными знаниями о том что происходит. 
        Но этими знаниями обладает тот, кто подготовит всю эту цепочку для использования.
    ";

    $clientCode = "";

    $replaceData = [$title, $description, $fileContent, $clientCode, $result];
    $section     = htmlSectionReplace($replaceData);
    echo $section;

}, []);


$designPatterns['strategy'] = renderPattern(function($args) use ($filesContent) {

    $result = strategyInit();

    $title = 'strategy';

    unset($filesContent[$title][0]);
    $fileContent = implode("", $filesContent[$title]);

    $description = "
        Стратегия — это поведенческий паттерн проектирования, который определяет семейство схожих алгоритмов и помещает каждый из них в собственный класс, 
        после чего алгоритмы можно взаимозаменять прямо во время исполнения программы.
        Чтобы разделить стратегии и получить возможность быстрого переключения между ними. 
        Также этот паттерн является хорошей альтернативой наследованию (вместо расширения абстрактного класса).
    ";

    $clientCode = "";

    $replaceData = [$title, $description, $fileContent, $clientCode, $result];
    $section     = htmlSectionReplace($replaceData);
    echo $section;

}, []);


$designPatterns['builder'] = renderPattern(function($args) use ($filesContent) {

    $result = builderInit();

    $title = 'builder';

    unset($filesContent[$title][0]);
    $fileContent = implode("", $filesContent[$title]);

    $description = "
        Строитель — это порождающий паттерн проектирования, который позволяет создавать сложные объекты пошагово. 
        Строитель даёт возможность использовать один и тот же код строительства для получения разных представлений объектов.
        Паттерн Строитель предлагает вынести конструирование объекта за пределы его собственного класса, поручив это дело отдельным объектам, называемым строителями.
    ";

    $clientCode = "";

    $replaceData = [$title, $description, $fileContent, $clientCode, $result];
    $section     = htmlSectionReplace($replaceData);
    echo $section;

}, []);


$designPatterns['abstract-factory'] = renderPattern(function($args) use ($filesContent) {

    $result = abstractFactoryInit();

    $title = 'abstract-factory';

    unset($filesContent[$title][0]);
    $fileContent = implode("", $filesContent[$title]);

    $description = "
        
    ";

    $clientCode = "";

    $replaceData = [$title, $description, $fileContent, $clientCode, $result];
    $section     = htmlSectionReplace($replaceData);
    echo $section;

}, []);


$designPatterns['factory-method'] = renderPattern(function($args) use ($filesContent) {


    $result = factoryMethodInit();

    $title = 'factory-method';

    unset($filesContent[$title][0]);
    $fileContent = implode("", $filesContent[$title]);

    $description = "
        
    ";

    $clientCode = "";

    $replaceData = [$title, $description, $fileContent, $clientCode, $result];
    $section     = htmlSectionReplace($replaceData);
    echo $section;

}, []);


$designPatterns['observer'] = renderPattern(function($args) use ($filesContent) {

    $result = observerInit();
    $title  = 'observer';

    unset($filesContent[$title][0]);
    $fileContent = implode("", $filesContent[$title]);

    $description = "
        
    ";

    $clientCode = "";
    $replaceData = [$title, $description, $fileContent, $clientCode, $result];
    $section     = htmlSectionReplace($replaceData);
    echo $section;

}, []);


//$designPatterns['decorator'] = renderPattern(function($args) {
//
//    echo headerPage('Decorator (Start)');
//
//
//    echo footerPage('Decorator (End)');
//
//}, []);



////////////////////////////////////////////////
////////////////////////////////////////////////
///
///


function lg()
{

    $out = '';
    $get = false;
    $style = 'margin:10px; padding:10px; border:3px red solid;';
    $args = func_get_args();
    foreach ($args as $key => $value) {
        $itemArr = array();
        $itemStr = '';
        is_array($value) ? $itemArr = $value : $itemStr = $value;
        if ($itemStr == 'get') $get = true;
        $line = print_r($value, true);
        $out .= '<div style="' . $style . '" ><pre>' . $line . '</pre></div>';
    }

    $debugTrace = debug_backtrace();
    $line = print_r($debugTrace, true);
    $out .= '<div style="' . $style . '" ><pre>' . $line . '</pre></div>';

    if ($get) return $out;
    print $out;
    exit;

}


function renderPattern($callback, $args = [])
{
    ob_start();

    $callback($args);

    $pattern = ob_get_contents();
    ob_end_clean();
    return $pattern;
}


function footerPage($data)
{
    $result = "<div>{$data}</div>";
    return $result;
}

function headerPage($data)
{
    $result = "<div>{$data}</div>";
    return $result;
}

function getFileName($path)
{
    $fileName = basename($path);
    $name = explode('.', $fileName);
    return $name[0];
}


function htmlSectionReplace($replaceData)
{

    ob_start();
    include __DIR__ .'/jackson/section.php';
    $section = ob_get_contents();
    ob_end_clean();
    $replaceTemplate = array("&_NAME_&", "&_DESC_&", "&_FILE-CONTENT_&", '&_CLIENT-CODE_&', '&_RESULT-CODE_&');
    $section = str_replace($replaceTemplate, $replaceData, $section);
    return $section;

};


function showMessage($value, $tag = 'div', $class = 'result-container') {
    $result = "
       <$tag> class='$class' >$value</$tag>
    ";
    return $result;
}


class ShowMessage {

    public $section = [];
    public $tag;
    public $class;

    public function __construct($value = '', $tag = 'div', $class = 'item-container')
    {
        $this->tag   = $tag;
        $this->class = $class;
        if($value) $this->message($value, $tag, $class);
    }

    public function message($value, $tag = null, $class = null) {
        $this->defaultStyle();
        if(!$tag) $tag = $this->tag ;
        if(!$class) $class = $this->class;
        $result = "
           <$tag class='$class' >$value</$tag>
        ";
        $this->section[] = $result;
    }

    public function result() {
        $result = implode('', $this->section);
        $this->section = [];
        return $result;
    }

    public function defaultStyle() {
        $this->tag   = 'div';
        $this->class = 'item-container';
    }
}
