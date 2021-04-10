<?php

// Интерфейса Наблюдателя
interface Observer
{
    public function update(Observable $instance);
}

// Интерфейса Субъекта
interface Observable
{
    public function attach(Observer $instance);
    public function detach(Observer $instance);
    public function notify();
    public function getValue(string $fname);
}


class UserUpdatedSubject implements Observable
{
    private $data      = [];
    private $observers = [];

    public function attach(Observer $instance) {
        $this->getMessage('Добавлен новый наблюдатель');
        foreach ($this->observers as $observer) {
            if ($instance === $observer)
                return false;
        }

        $this->observers[] = $instance;
    }

    public function detach(Observer $instance) {
        $this->getMessage('Удален наблюдатель');
        foreach ($this->observers as $key => $observer) {
            if ($instance === $observer)
                unset($this->observers[$key]);
        }
    }

    public function notify()  {
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }

    public function create(array $data) {
        $this->data = $data;
        $userName = $this->getValue('username');
        $this->getMessage('Произошло новое событие:на работу принят работник - ' . $userName);
        $this->notify();
    }

    public function getValue(string $fname) {
        $result = (!empty($this->data[$fname])) ? $this->data[$fname] : ' Empty username';
        return $result;
    }

    private function getMessage($message) {
        echo "<br><br>" . __CLASS__ . ' : ' . $message . "<br><br>";
    }
}


class StoreDepartment implements Observer
{
    private function getMessage($message) {
        echo "<br><br>" . __CLASS__ . ' : ' . $message . "<br><br>";
    }

    public function update(Observable $subject) {
        $userName = $subject->getValue('username');
        $message = "Пользователю $userName выписан со склада  : Монитор, системный блок,мышка,клавиатура,телефонный аппарат";
        $this->getMessage($message);
    }
}

class FinancialDepartment implements Observer
{
    private function getMessage($message) {
        echo "<br><br>" . __CLASS__ . ' : ' . $message . "<br><br>";
    }

    public function update(Observable $subject) {
        $userName = $subject->getValue('username');
        $message = "Пользователю $userName заказа дебетовая карта в банке 'BTБ'";
        $this->getMessage($message);
    }
}
