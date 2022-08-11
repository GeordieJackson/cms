<?php

    namespace App\Services;

    use function session;

    class Flash
    {
        public function __construct()
        {
            if ( ! session()->has('flash')) {
                session()->put('flash', [
                        'message' => '',
                        'title' => '',
                        'level' => 'info',
                        'type' => 'alert',
                        'important' => false,
                    ]);
            }
        }

        public function message(string $message = '')
        {
            $this->{$this->getLevel()}($message);

            return $this;
        }

        public function title(string $title = '')
        {
            session()->put('flash.title', $title);

            return $this;
        }

        public function type(string $type = 'alert')
        {
            session()->put('flash.type', $type);

            return $this;
        }

        public function level(string $level)
        {
            session()->put('flash.level', $level);

            if ($level == 'warning' || $level == 'danger') {
                $this->important();
            }

            return $this;
        }

        public function important($importance = true)
        {
            session()->put('flash.important', $importance);

            return $this;
        }

        public function success($message = '')
        {
            session()->put('flash.level', 'success');

            if ($message) {
                session()->put('flash.message', $message);
            }

//            if (session('flash')['title'] == '') {
//                $this->title('Success');
//            }

            return $this;
        }

        public function info($message = '')
        {
            session()->put('flash.level', 'info');

            if ($message) {
                session()->put('flash.message', $message);
            }

//            if (session('flash')['title'] == '') {
//                $this->title('Information');
//            }

            return $this;
        }

        public function danger($message = '')
        {
            session()->put('flash.level', 'danger');

            if ($message) {
                session()->put('flash.message', $message);
            }

//            if (session('flash')['title'] == '') {
//                $this->title('Danger');
//            }

            $this->important();

            return $this;
        }

        public function warning($message = '')
        {
            session()->put('flash.level', 'warning');

            if ($message) {
                session()->put('flash.message', $message);
            }

//            if (session('flash')['title'] == '') {
//                $this->title('Warning');
//            }

            $this->important();

            return $this;
        }

        public function forget()
        {
            session()->forget('flash');
        }

        // Getters

        public function getMessage()
        {
            return session('flash.message') ?? null;
        }

        public function getTitle()
        {
            return session('flash.title') ?? null;
        }

        public function getLevel()
        {
            return session('flash.level') ?? null;
        }

        public function getType()
        {
            return session('flash.type') ?? null;
        }

        public function getImportance()
        {
            return session('flash.important') ?? null;
        }
    }
