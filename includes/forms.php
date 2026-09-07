<?php
function tbk_field(array $f): void {
  $name=e($f['name']); $label=e($f['label']); $type=$f['type']??'text'; $help=$f['help']??'';
  echo '<div class="field"><label for="'.$name.'">'.$label.'</label>';
  if($type==='textarea') {
    echo '<textarea id="'.$name.'" name="'.$name.'" placeholder="'.e($f['placeholder']??'').'" rows="6"></textarea>';
  } elseif($type==='select') {
    echo '<select id="'.$name.'" name="'.$name.'">'; foreach($f['options']??[] as $o){ echo '<option value="'.e((string)$o[0]).'">'.e((string)$o[1]).'</option>'; } echo '</select>';
  } elseif($type==='checkbox') {
    echo '<label class="check"><input id="'.$name.'" name="'.$name.'" type="checkbox" '.(!empty($f['checked'])?'checked':'').'><span>'.($help?e($help):'Enabled').'</span></label>'; $help='';
  } else {
    $attrs=''; foreach(['min','max','step','accept'] as $a) if(isset($f[$a])) $attrs.=' '.$a.'="'.e((string)$f[$a]).'"';
    echo '<input id="'.$name.'" name="'.$name.'" type="'.e($type).'" placeholder="'.e($f['placeholder']??'').'"'.$attrs.'>';
  }
  if($help) echo '<div class="field-help">'.e($help).'</div>'; echo '</div>';
}
function tbk_render_fields(array $fields): void { foreach($fields as $f) tbk_field($f); }
