<?php

require_once __DIR__ . "/../Feature/Feature.php";
require_once __DIR__ . "/../View/ConsoleView.php";
require_once __DIR__ . "/../View/View.php";
require_once __DIR__ . "/../State/State.php";
require_once __DIR__ . "/../Traits/RepeatAskingInput.php";
class Kernel
{
    use RepeatAskingInput;
    /**
     * @var array<Feature>
     */
    private array $features = [];

    public function __construct(
        protected View $view,
        private readonly State $state,
    )
    {
    }

    function registerCommand(int $option, Feature $feature): void
    {
        $this->features[$option] = $feature;
    }

    function run(): void
    {
        while ($this->state->isRunning){
            $this->view->preRender();
            $this->view->renderHeader();
            $this->view->renderList($this->features, fn ($command, $key) => "$key. {$command->label()}\n");

            $inp = (int) $this->repeatAsking("Enter Number: ", fn ($input) => !array_key_exists($input, $this->features));
            $this->features[$inp]->preRun();
            $this->features[$inp]->run();
            $this->features[$inp]->postRun();

            $this->view->getInput("Press ENTER Key To Continue");
        }
    }

}
