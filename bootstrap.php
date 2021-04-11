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

    // Существующие сервисы
    $twitter  = new TwitterService();
    $facebook = new FacebookService();

    // Сервис который адаптируем
    $instagramm = new InstagrammService();
    $adapterInstagramm = new AdapterInstagrammService($instagramm);

    // Создаем senders
    $twitterSender    = new SocialServiceClientClass($twitter);
    $facebookSender   = new SocialServiceClientClass($facebook);
    $instagrammSender = new SocialServiceClientClass($adapterInstagramm);

    // Отправляем сообщения в сервисы
    $result =  $twitterSender->newMessageSender('maikl-dzion'     , '1234'     , 'Привет сообщество!Как жизнь?') . "<br>";
    $result .= $facebookSender->newMessageSender('fillip-maker'   , 'urty65756', 'Всем желаю доброго утра!!!');         echo "<br>";
    $result .= "[InstagrammService имеет нестандартный интерфейс]" . $instagrammSender->newMessageSender('swide@mail.ru', 'gfhdggd'  , 'Продаю платяной шкаф (антиквариат)') . "<br>";

    //echo footerPage('Adapter Pattern (End)');

    unset($filesContent['adapter'][0]);
    $fileContent = implode("", $filesContent['adapter']);

    $desc = 'Привести нестандартный или неудобный интерфейс какого-то класса в интерфейс, совместимый с вашим кодом.
             Адаптер позволяет классам работать вместе стандартным образом, что обычно не получается из-за несовместимых интерфейсов,
             предоставляя для этого прослойку с интерфейсом, удобным для клиентов, самостоятельно используя оригинальный интерфейс.';

    $clientCode = ' $twitter  = new TwitterService();
                    $facebook = new FacebookService();
                
                    // Сервис который адаптируем
                    $instagramm = new InstagrammService();
                    $adapterInstagramm = new AdapterInstagrammService($instagramm);
                
                    // Создаем senders
                    $twitterSender    = new SocialServiceClientClass($twitter);
                    $facebookSender   = new SocialServiceClientClass($facebook);
                    $instagrammSender = new SocialServiceClientClass($adapterInstagramm);';

    $resultCode = $result;

    ob_start();
    include __DIR__ .'/jackson/section.php';
    $section = ob_get_contents();
    ob_end_clean();

    $healthy = array("&_NAME_&", "&_DESC_&", "&_FILE-CONTENT_&", '&_CLIENT-CODE_&', '&_RESULT-CODE_&');
    $yummy   = array("Adapter", $desc  , $fileContent    , $clientCode    , $resultCode);
    $html = str_replace($healthy, $yummy, $section);

    echo $html;

}, []);


$designPatterns['decorator'] = renderPattern(function($args) {

    $bookList = [
        [
            'name' => 'Я легенда',
            'author' => 'Ричард Матесон',
            'price' => 313,
            'year'  => 2020,
            'publish' => 'Азбука'
        ],

        [
            'name' => 'Метро 2033',
            'author' => 'Глуховский Дмитрий',
            'price' => 704,
            'year'  => 2019,
            'publish' => 'АСТ'
        ],

        [
            'name' => 'Град обреченный',
            'author' => 'Стругацкий Аркадий',
            'price' => 220,
            'year'  => 2016,
            'publish' => 'АСТ'
        ],
    ];


    echo headerPage('Decorator (Start)');

    echo '<br> Определение <br>
      <br/>  Декоратор — это структурный паттерн, который позволяет добавлять объектам новые поведения на лету, помещая их в объекты-обёртки.
      <br/>  Декоратор позволяет оборачивать объекты бесчисленное количество раз благодаря тому, что и обёртки,
      <br/>  и реальные оборачиваемые объекты имеют общий интерфейс. <br>';

    $bookSimple = new BookListSimple($bookList);

    $bookServiceClient = new BookServiceClentCode($bookSimple);
    echo "<h4> Простой список книг </h4>";
    echo $bookServiceClient->show(); echo "<br>";

    $bookDecorator1 = new BookListAddPriceAndYearDecorator($bookSimple);
    $bookServiceClient = new BookServiceClentCode($bookDecorator1);
    echo "<h4> Оборачиваем простой список и добавляем цену и год </h4>";
    echo $bookServiceClient->show(); echo "<br>";

    $bookDecorator2 = new BookListAddPublichDecorator($bookDecorator1);
    $bookServiceClient = new BookServiceClentCode($bookDecorator2);
    echo "<h4> Оборачиваем список и добавляем издательство </h4>";
    echo $bookServiceClient->show(); echo "<br>";

    echo footerPage('Decorator (End)');

}, []);


$designPatterns['command'] = renderPattern(function($args) {

    echo headerPage('Command (Start)');

    echo '<br> Определение <br>
         
          <br><br>';

    $airSystem = new AirDefenseSystemControl();

    $command1 = new TargetTrackingCommand($airSystem);
    $commandClientCode = new CommandServiceClientCode($command1);
    echo "<h5> Выдана команда на отслеживание целей </h5>";
    echo $commandClientCode->start(); echo "<br>";

    $command2 = new TargetQuidanceCommand($airSystem);
    $commandClientCode = new CommandServiceClientCode($command2);
    echo "<h5> Наводим на цель </h5>";
    echo $commandClientCode->start(); echo "<br>";

    $command3 = new DestroyTargetgCommand($airSystem);
    $commandClientCode = new CommandServiceClientCode($command3);
    echo "<h5> Выдана команда на уничтожение цели </h5>";
    echo $commandClientCode->start(); echo "<br>";

    $commandClientCode = new CommandServiceClientCode($command1);
    echo "<h5> Выдана команда на отмену отслеживания целей </h5>";
    echo $commandClientCode->undo(); echo "<br>";

    echo footerPage('Command (End)');

}, []);


$designPatterns['strategy'] = renderPattern(function($args) {

    echo headerPage('Strategy (Start)');

    echo '<br> Определение <br>
         <br><br>';

    $smtpMail = new SmtpMailSender();
    $mailSender = new StrategySendMessageServiceClientCode($smtpMail);
    echo "<br>" .$mailSender->send('Привет,нужна помощь');

    $simpleMail = new SimpleMailSender();
    $mailSender = new StrategySendMessageServiceClientCode($simpleMail);
    echo "<br><br>" . $mailSender->send('Добрый день,передаю документы по почте');

    echo footerPage('Strategy (End)');

}, []);


$designPatterns['builder'] = renderPattern(function($args) {
    echo headerPage('Builder (Start)');

    $compBuilder = new ComputerBuilder();
    $newComputer = $compBuilder->cpu('Core I5 [4356-rt-56]')
                               ->system('Asus 567')
                               ->_case('Inwin 450')
                               ->power('500W')
                               ->ram('Kingston 16Gb')
                               ->gpu('Nvidia 660')
                               ->hdd('WD 2Tb')
                               ->get();

    echo $newComputer->createOrder();

    echo footerPage('Builder (End)');
}, []);


$designPatterns['abstract-factory'] = renderPattern(function($args) {
    echo headerPage('AbstractFactory (Start)');

    echo '<br> Определение <br>
          <br><br>';

    $woodenHouseFactory = new WoodenHouseFactory();
    $houseBuild = new AbstarctFactoryClientCode($woodenHouseFactory);
    echo $houseBuild->run();
    echo "<br><br>";

    $brickHouseFactory = new BrickHouseFactory();
    $houseBuild = new AbstarctFactoryClientCode($brickHouseFactory);
    echo $houseBuild->run();
    echo "<br><br>";

    echo footerPage('AbstractFactory (End)');
}, []);


$designPatterns['factory-method'] = renderPattern(function($args) {
    echo headerPage('FactoryMethod (Start)');

    echo '<br> Определение <br>
          <br><br>';

    $truckerTransport = new TruckerLogisticFactoryMethod();
    $clientLogistic   = new FactoryLogisticClientCode($truckerTransport);
    echo "<br>" . implode("<br>", $clientLogistic->run());

    echo "<br><br>";

    $smallTransport = new SmallTransportLogisticFactoryMethod();
    $clientLogistic = new FactoryLogisticClientCode($smallTransport);
    echo "<br>" . implode("<br>", $clientLogistic->run());

    echo footerPage('FactoryMethod (End)');
}, []);



$designPatterns['observer'] = renderPattern(function($args) {

    echo headerPage('Observer (Start)');

    echo '<br> Определение <br>
          <br><br>';

    $newUser = [
        "username"  => "John Smith",
        "email" => "john99@example.com",
    ];

    // Генератор новых событий
    $userUpdated = new UserUpdatedSubject();

    // Наблюдатели
    $store       = new StoreDepartment();
    $finance     = new FinancialDepartment();

    $userUpdated->attach($store);
    $userUpdated->attach($finance);

    $userUpdated->create($newUser);

    echo footerPage('Observer (End)');
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


function htmlSectionRender() {

};
