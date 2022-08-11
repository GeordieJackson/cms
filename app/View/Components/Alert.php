<?php

    namespace App\View\Components;

    use Illuminate\View\Component;

    use function session;

    class Alert extends Component
    {
        public $type = 'alert';
        public $level;
        public $title;
        public $message;
        public $important;
        public $alert_set;

        /**
         * Create a new component instance.
         *
         * @return void
         */
        public function __construct()
        {
            $this->alert_set = session('flash.type') == 'alert' ? ' js-alert-set' : '';
            $this->level = session('flash')['level'] ?? 'info';
            $this->title = session('flash')['title'] ?? '';
            $this->message = session('flash')['message'] ?? '';
            $this->setImportanceLevel();

            session()->forget('flash');
        }

        /**
         * Get the view / contents that represent the component.
         *
         * @return \Illuminate\View\View|string
         */
        public function render()
        {
            return view('components.alert');
        }

        /**
         *  Force important level for critical messages
         */
        protected function setImportanceLevel()
        {
            $this->important = '';

            if($this->level == 'danger' || $this->level == 'warning') {
                $this->important = '-important';
            }

            if(isset(session('flash')['important'])) {
                $this->important = session('flash')['important'] ? '-important' : '';
            }
        }
    }
