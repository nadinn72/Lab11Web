<?php
/**
 * Nama Class: Form
 * Deskripsi: Class untuk membuat form inputan dinamis
 */
class Form
{
    private $fields = array();
    private $action;
    private $submit = "Submit Form";
    private $jumField = 0;
    private $method = "POST";

    public function __construct($action = "", $submit = "Submit Form", $method = "POST")
    {
        $this->action = $action;
        $this->submit = $submit;
        $this->method = $method;
    }

    public function displayForm()
    {
        echo "<form action='". $this->action . "' method='". $this->method ."'>";
        echo '<table class="form-table">';

        foreach ($this->fields as $field) {
            echo "<tr>";
            echo "<td align='right' valign='top' width='30%'>";
            echo "<label>" . $field['label'] . "</label>";
            echo "</td>";
            echo "<td width='70%'>";

            // Jika ada nilai sebelumnya, gunakan itu
            $value = isset($field['value']) ? $field['value'] : '';

            switch ($field['type']) {
                case 'textarea':
                    echo "<textarea name='". $field['name']. "' cols='30' rows='6' class='form-textarea'>". htmlspecialchars($value) ."</textarea>";
                    break;

                case 'select':
                    echo "<select name='". $field['name']. "' class='form-select'>";
                    foreach ($field['options'] as $val => $label) {
                        $selected = ($value == $val) ? 'selected' : '';
                        echo "<option value='". $val . "' ". $selected .">". $label ."</option>";
                    }
                    echo "</select>";
                    break;

                case 'radio':
                    echo "<div class='radio-group'>";
                    foreach ($field['options'] as $val => $label) {
                        $checked = ($value == $val) ? 'checked' : '';
                        echo "<label><input type='radio' name='". $field['name']. "' value='". $val . "' ". $checked ."> ". $label . "</label> ";
                    }
                    echo "</div>";
                    break;

                case 'checkbox':
                    echo "<div class='checkbox-group'>";
                    if(is_array($value)) {
                        $checkedValues = $value;
                    } else {
                        $checkedValues = explode(',', $value);
                    }
                    foreach ($field['options'] as $val => $label) {
                        $checked = in_array($val, $checkedValues) ? 'checked' : '';
                        echo "<label><input type='checkbox' name='". $field['name']. "[]' value='". $val . "' ". $checked ."> ". $label . "</label> ";
                    }
                    echo "</div>";
                    break;

                case 'password':
                    echo "<input type='password' name='". $field['name']. "' class='form-input'>";
                    break;
                    
                default:
                    echo "<input type='". $field['type']. "' name='". $field['name']. "' value='". htmlspecialchars($value) ."' class='form-input'>";
                    break;
            }
            echo "</td></tr>";
        }
        
        echo "<tr><td colspan='2' style='text-align: center; padding-top: 20px;'>";
        echo "<input type='submit' value='". $this->submit . "' class='btn btn-submit'>";
        echo "</td></tr>";
        echo "</table>";
        echo "</form>";
    }

    /**
     * addField - Menambahkan field ke form
     */
    public function addField($name, $label, $type = "text", $options = array(), $value = '')
    {
        $this->fields[$this->jumField]['name'] = $name;
        $this->fields[$this->jumField]['label'] = $label;
        $this->fields[$this->jumField]['type'] = $type;
        $this->fields[$this->jumField]['options'] = $options;
        $this->fields[$this->jumField]['value'] = $value;
        $this->jumField++;
    }
}
?>