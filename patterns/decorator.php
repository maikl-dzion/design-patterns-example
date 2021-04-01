<?php

interface BookRenderInterface
{
    public function render(): array;
    public function wrapper(string $data) : string;
    public function getBookList() : array;
}


// Исходный класс,который будем декорировать (добавлять функциональность динамически)
class BookListSimple implements BookRenderInterface
{
    protected $bookList;

    public function __construct($bookList)
    {
        $this->bookList = $bookList;
    }

    public function render() : array {
        $result = [];
        foreach ($this->bookList as $key => $book) {
            $name   = $this->wrapper('Название :' . $book['name']);
            $author = $this->wrapper('Автор :' .$book['author']);
            // $item = ['name'   => $name, 'author' => $author];
            $item   = $name . $author;
            $result[] = $item;
        }
        return $result;
    }

    public function wrapper(string $data) : string {
        return "<div>{$data}</div>";
    }

    public function getBookList() : array {
        return $this->bookList;
    }
}

// Первый декоратор добавляем цену и год
class BookListAddPriceAndYearDecorator implements BookRenderInterface
{
    protected $bookSimple;
    protected $bookList;

    public function __construct(BookListSimple $bookSimple)
    {
        $this->bookSimple = $bookSimple;
        $this->bookList   = $this->bookSimple->getBookList();
    }

    public function render() : array {
        $resultList = $this->bookSimple->render();

        foreach ($this->bookList as $key => $book) {
            $price   = $this->wrapper('Цена :' . $book['price']);
            $year    = $this->wrapper('Год  :' . $book['year']);
            $item    = '<div style="color:red">' . $price . $year . '</div>';
            $resultList[$key] .= $item;
        }
        return $resultList;
    }

    public function wrapper(string $data) : string {
        return "<div>{$data}</div>";
    }

    public function getBookList() : array {
        return $this->bookList;
    }
}

// Второй декоратор добавляем издательство
class BookListAddPublichDecorator implements BookRenderInterface
{
    protected $bookService;
    protected $bookList;

    public function __construct(BookRenderInterface $bookService)
    {
        $this->bookService = $bookService;
        $this->bookList    = $this->bookService->getBookList();
    }

    public function render() : array {
        $resultList = $this->bookService->render();
        foreach ($this->bookList as $key => $book) {
            $publish   = $this->wrapper('Издательство :' . $book['publish']);
            $resultList[$key] .= '<div style="color:blue">' . $publish. '</div>';
        }
        return $resultList;
    }

    public function wrapper(string $data) : string {
        return "<div>{$data}</div>";
    }

    public function getBookList() : array {
        return $this->bookList;
    }
}


class BookServiceClentCode {

    protected $bookRender;

    public function __construct(BookRenderInterface $bookRender)
    {
        $this->bookRender = $bookRender;
    }

    public function show() {
        $list = $this->bookRender->render();
        $html = '';
        foreach ($list as $key => $row) {
            $html .= "<div style='border:1px gainsboro solid; margin:2px 2px 2px 20px; padding: 2px; width: 200px;'>{$row}</div>";
        }
        return $html;
    }

}


//class TextFormatter implements InputFormatInterface
//{
//    /**
//     * @var InputFormat
//     */
//    protected $inputFormat;
//
//    public function __construct(InputFormatInterface $inputFormat)
//    {
//        $this->inputFormat = $inputFormat;
//    }
//
//    /**
//     * Декоратор делегирует всю работу обёрнутому компоненту.
//     */
//    public function formatText(string $text): string
//    {
//        return $this->inputFormat->formatText($text);
//    }
//}
//
///**
// * Этот Конкретный Декоратор удаляет все теги HTML из данного текста.
// */
//class PlainTextFilter extends TextFormatter
//{
//    public function formatText(string $text): string
//    {
//        $text = parent::formatText($text);
//        return strip_tags($text);
//    }
//}
//
//
//class DangerousHTMLTagsFilter extends TextFormatter
//{
//    private $dangerousTagPatterns = [
/*        "|<script.*?>([\s\S]*)?</script>|i", // ...*/
//    ];
//
//    private $dangerousAttributes = [
//        "onclick", "onkeypress", // ...
//    ];
//
//
//    public function formatText(string $text): string
//    {
//        $text = parent::formatText($text);
//
//        foreach ($this->dangerousTagPatterns as $pattern) {
//            $text = preg_replace($pattern, '', $text);
//        }
//
//        foreach ($this->dangerousAttributes as $attribute) {
//            $text = preg_replace_callback('|<(.*?)>|', function ($matches) use ($attribute) {
//                $result = preg_replace("|$attribute=|i", '', $matches[1]);
//                return "<" . $result . ">";
//            }, $text);
//        }
//
//        return $text;
//    }
//}
//
//
//class MarkdownFormat extends TextFormatter
//{
//    public function formatText(string $text): string
//    {
//        $text = parent::formatText($text);
//
//        // Форматирование элементов блока.
//        $chunks = preg_split('|\n\n|', $text);
//        foreach ($chunks as &$chunk) {
//            // Форматирование заголовков.
//            if (preg_match('|^#+|', $chunk)) {
//                $chunk = preg_replace_callback('|^(#+)(.*?)$|', function ($matches) {
//                    $h = strlen($matches[1]);
//                    return "<h$h>" . trim($matches[2]) . "</h$h>";
//                }, $chunk);
//            } // Форматирование параграфов.
//            else {
//                $chunk = "<p>$chunk</p>";
//            }
//        }
//        $text = implode("\n\n", $chunks);
//
//        // Форматирование встроенных элементов.
//        $text = preg_replace("|__(.*?)__|", '<strong>$1</strong>', $text);
//        $text = preg_replace("|\*\*(.*?)\*\*|", '<strong>$1</strong>', $text);
//        $text = preg_replace("|_(.*?)_|", '<em>$1</em>', $text);
//        $text = preg_replace("|\*(.*?)\*|", '<em>$1</em>', $text);
//
//        return $text;
//    }
//}
//
//
//function displayCommentAsAWebsite(InputFormatInterface $format, string $text)
//{
//
//    return $format->formatText($text);
//
//}



//interface InputFormatInterface
//{
//    public function formatText(string $text): string;
//}
//
//class TextInput implements InputFormatInterface
//{
//    public function formatText(string $text): string
//    {
//        return $text;
//    }
//}
//
//
//class TextFormatter implements InputFormatInterface
//{
//    /**
//     * @var InputFormat
//     */
//    protected $inputFormat;
//
//    public function __construct(InputFormatInterface $inputFormat)
//    {
//        $this->inputFormat = $inputFormat;
//    }
//
//    /**
//     * Декоратор делегирует всю работу обёрнутому компоненту.
//     */
//    public function formatText(string $text): string
//    {
//        return $this->inputFormat->formatText($text);
//    }
//}
//
///**
// * Этот Конкретный Декоратор удаляет все теги HTML из данного текста.
// */
//class PlainTextFilter extends TextFormatter
//{
//    public function formatText(string $text): string
//    {
//        $text = parent::formatText($text);
//        return strip_tags($text);
//    }
//}
//
//
//class DangerousHTMLTagsFilter extends TextFormatter
//{
//    private $dangerousTagPatterns = [
/*        "|<script.*?>([\s\S]*)?</script>|i", // ...*/
//    ];
//
//    private $dangerousAttributes = [
//        "onclick", "onkeypress", // ...
//    ];
//
//
//    public function formatText(string $text): string
//    {
//        $text = parent::formatText($text);
//
//        foreach ($this->dangerousTagPatterns as $pattern) {
//            $text = preg_replace($pattern, '', $text);
//        }
//
//        foreach ($this->dangerousAttributes as $attribute) {
//            $text = preg_replace_callback('|<(.*?)>|', function ($matches) use ($attribute) {
//                $result = preg_replace("|$attribute=|i", '', $matches[1]);
//                return "<" . $result . ">";
//            }, $text);
//        }
//
//        return $text;
//    }
//}
//
//
//class MarkdownFormat extends TextFormatter
//{
//    public function formatText(string $text): string
//    {
//        $text = parent::formatText($text);
//
//        // Форматирование элементов блока.
//        $chunks = preg_split('|\n\n|', $text);
//        foreach ($chunks as &$chunk) {
//            // Форматирование заголовков.
//            if (preg_match('|^#+|', $chunk)) {
//                $chunk = preg_replace_callback('|^(#+)(.*?)$|', function ($matches) {
//                    $h = strlen($matches[1]);
//                    return "<h$h>" . trim($matches[2]) . "</h$h>";
//                }, $chunk);
//            } // Форматирование параграфов.
//            else {
//                $chunk = "<p>$chunk</p>";
//            }
//        }
//        $text = implode("\n\n", $chunks);
//
//        // Форматирование встроенных элементов.
//        $text = preg_replace("|__(.*?)__|", '<strong>$1</strong>', $text);
//        $text = preg_replace("|\*\*(.*?)\*\*|", '<strong>$1</strong>', $text);
//        $text = preg_replace("|_(.*?)_|", '<em>$1</em>', $text);
//        $text = preg_replace("|\*(.*?)\*|", '<em>$1</em>', $text);
//
//        return $text;
//    }
//}
//
//
//function displayCommentAsAWebsite(InputFormatInterface $format, string $text)
//{
//
//    return $format->formatText($text);
//
//}
