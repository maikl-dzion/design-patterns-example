<?php


// require_once __DIR__ . '/autoloader.php';
//\spl_autoload_register('Autoloader::autoload');

$files = glob(__DIR__ . '/patterns/*.php');

foreach ($files as $key => $filePath) {
    require_once $filePath;
}


//$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
//$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$

echo '<h2> ----- Adapter Pattern start ------- </h2>';

echo '<br> Определение <br>

          <br/> Привести нестандартный или неудобный интерфейс какого-то класса в интерфейс, совместимый с вашим кодом. 
          <br/> Адаптер позволяет классам работать вместе стандартным образом, что обычно не получается из-за несовместимых интерфейсов, 
          <br/> предоставляя для этого прослойку с интерфейсом, удобным для клиентов, самостоятельно используя оригинальный интерфейс.
           
      <br><br>';


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
echo $twitterSender->newMessageSender('maikl-dzion'     , '1234'     , 'Привет сообщество!Как жизнь?');       echo "<br>";
echo $facebookSender->newMessageSender('fillip-maker'   , 'urty65756', 'Всем желаю доброго утра!!!');         echo "<br>";
echo "[InstagrammService имеет нестандартный интерфейс]" . $instagrammSender->newMessageSender('swide@mail.ru', 'gfhdggd'  , 'Продаю платяной шкаф (антиквариат)'); echo "<br>";

echo '<br> ------ Adapter Pattern end ----- <br>';

//$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
//$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$

echo '<h2> ----- Decorator Pattern start ------- </h2>';

echo '<br> Определение <br>
      <br/>  Декоратор — это структурный паттерн, который позволяет добавлять объектам новые поведения на лету, помещая их в объекты-обёртки. 
      <br/>  Декоратор позволяет оборачивать объекты бесчисленное количество раз благодаря тому, что и обёртки, 
      <br/>  и реальные оборачиваемые объекты имеют общий интерфейс. <br>';

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



echo '<br> ------ Decorator Pattern end ----- <br>';


//$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
//$$$$$$$$$$$$$$$          COMMAND PATTERN      $$$$$$$$$$$$$$$$$$$$$$$$$$$$$

echo '<h2> ----- Command Pattern start ------- </h2>';

echo '<br> Определение <br>
      <br/>
      
        

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


echo '<br> ------ Command Pattern end ----- <br><br>';


//$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
//$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$

echo '<h2> ----- Strategy Pattern start ------- </h2>';

echo '<br> Определение <br>

          <br/>
    
      <br><br>';

$smtpMail = new SmtpMailSender();
$mailSender = new StrategySendMessageServiceClientCode($smtpMail);
echo "<br>" .$mailSender->send('Привет,нужна помощь');

$simpleMail = new SimpleMailSender();
$mailSender = new StrategySendMessageServiceClientCode($simpleMail);
echo "<br><br>" . $mailSender->send('Добрый день,передаю документы по почте');

echo '<br><br> ------ Strategy Pattern end ----- <br><br>';


//$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
//$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$

echo '<h2> ----- FactoryMethod Pattern start ------- </h2>';

echo '<br> Определение <br>
      <br/>
   
      <br><br>';

$truckerTransport = new TruckerLogisticFactoryMethod();
$clientLogistic   = new FactoryLogisticClientCode($truckerTransport);
echo "<br>" . implode("<br>", $clientLogistic->run());

echo "<br><br>";

$smallTransport = new SmallTransportLogisticFactoryMethod();
$clientLogistic = new FactoryLogisticClientCode($smallTransport);
echo "<br>" . implode("<br>", $clientLogistic->run());

echo "<br> ------ FactoryMethod Pattern end ----- <br><br>";


//$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
//$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$

echo '<h2> ----- AbstractFactory Pattern start ------- </h2>';

echo '<br> Определение <br>
      <br/>
   
      <br><br>';

$woodenHouseFactory = new WoodenHouseFactory();
$houseBuild = new AbstarctFactoryClientCode($woodenHouseFactory);
echo $houseBuild->run();
echo "<br><br>";

$brickHouseFactory = new BrickHouseFactory();
$houseBuild = new AbstarctFactoryClientCode($brickHouseFactory);
echo $houseBuild->run();
echo "<br><br>";

echo "<br> ------ AbstractFactory Pattern end ----- <br><br>";







////////////////////////////////////////////////
////////////////////////////////////////////////
///
///
///
///
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
