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
    private $session;

    private function __construct() { }

    public static function getInstance() {
        if (is_null(self::$instance)) {
            self::$instance = new FoodCareTaker();
            self::$instance->undoStack = array();
            self::$instance->redoStack = array();
            self::$instance->session = SessionManager::getInstance();
        }
        return self::$instance;
    }

    /**
     * This method should be invoked after any changes to the FoodData. It
     * pushes the last unsaved change into the UndoStack.
     * @param Memento $memento
     */
    public function record(Memento &$memento) {
      $this->redoStack = array();
      $this->session->setRedoStack($this->redoStack);

      $this->current = $this->session->getCurrentUndo();
      if (!is_null($this->current)) {
        $this->undoStack = &$this->session->getUndoStack();
        array_push($this->undoStack, $this->current);
        $this->session->setUndoStack($this->undoStack);
      }

      $this->current = $memento;
      $this->session->setCurrentUndo($this->current);

      $this->current = $this->session->getCurrentUndo();
    }

    /**
     * Invoked when the user wants to undo a change in the FoodData
     * @return Memento
     */
    public function undo() {
      $this->redoStack = $this->session->getRedoStack();
      $this->undoStack = $this->session->getUndoStack();
      $this->current = $this->session->getCurrentUndo();

      if ($this->countUndo() > 0) {
        $this->undoStack = $this->session->getUndoStack();
        array_push($this->redoStack, $this->current);
        $this->current = array_pop($this->undoStack);

        $this->session->setRedoStack($this->redoStack);
        $this->session->setUndoStack($this->undoStack);
        $this->session->setCurrentUndo($this->current);
      }

      return $this->current;
    }

    /**
     * Invoked when the user wants to redo an undone change in the FoodData
     * @return Memento
     */
    public function redo() {
      $this->redoStack = $this->session->getRedoStack();
      $this->undoStack = $this->session->getUndoStack();
      $this->current = $this->session->getCurrentUndo();

      if ($this->countRedo() > 0) {
        $this->redoStack = $this->session->getRedoStack();
        array_push($this->undoStack, $this->current);
        $this->current = array_pop($this->redoStack);

        $this->session->setRedoStack($this->redoStack);
        $this->session->setUndoStack($this->undoStack);
        $this->session->setCurrentUndo($this->current);
      }

      return $this->current;
    }

    /**
     * Counts the elements in the RedoStack.
     * @return int Count of redo actions available.
     */
    public function countRedo() {
      $this->redoStack = &$this->session->getRedoStack();
      return count($this->redoStack);
    }

    /**
     * Counts the elements in the UndoStack.
     * @return int Count of undo actions available.
     */
    public function countUndo() {
      $this->undoStack = &$this->session->getUndoStack();
      return count($this->undoStack);
    }
}

?>
