<?php

/**
 * The caretaker of the memento design pattern.
 * Holds a list of memento objets and is reponsible for managing them.
 *
 * NOTE: We are unwillingly using the session here because we are simulating the
 * Singleton Pattern. All the properties are reset everytime the getInstance()
 * method is invoked, which, in a web application, seems to be always. Having
 * the session helps us simulate said pattern.
 */
class FoodCareTaker {

    private $undoStack;
    private $redoStack;
    private $current;
    private static $instance;

    private function __construct() { }

    public static function getInstance() {
        self::$instance = SessionManager::getInstance()->getFoodCareTaker();

        if (is_null(self::$instance)) {
            self::$instance = new FoodCareTaker();
            SessionManager::getInstance()->setFoodCareTaker(self::$instance);
            self::$instance->undoStack = array();
            self::$instance->redoStack = array();
        }

        return self::$instance;
    }

    /**
     * This method should be invoked after any changes to the FoodData. It
     * pushes the last unsaved change into the UndoStack.
     * @param Memento $memento
     */
    public function record(Memento $memento) {
      $this->redoStack = array();

      if (!is_null($this->current)) {
        array_push($this->undoStack, $this->current);
      }

      $this->current = $memento;
    }

    /**
     * Invoked when the user wants to undo a change in the FoodData
     * @return Memento
     */
    public function undo() {

      if ($this->countUndo() > 0) {
        array_push($this->redoStack, $this->current);
        $this->current = array_pop($this->undoStack);
      }

      return $this->current;
    }

    /**
     * Invoked when the user wants to redo an undone change in the FoodData
     * @return Memento
     */
    public function redo() {

      if ($this->countRedo() > 0) {
        array_push($this->undoStack, $this->current);
        $this->current = array_pop($this->redoStack);
      }

      return $this->current;
    }

    /**
     * Counts the elements in the RedoStack.
     * @return int Count of redo actions available.
     */
    public function countRedo() {
      return count($this->redoStack);
    }

    /**
     * Counts the elements in the UndoStack.
     * @return int Count of undo actions available.
     */
    public function countUndo() {
      return count($this->undoStack);
    }
}

?>
