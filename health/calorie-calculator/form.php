<?php require_once TBK_ROOT.'/includes/forms.php'; tbk_render_fields([
['name'=>'sex','label'=>'Sex used by equation','type'=>'select','options'=>[['male','Male'],['female','Female']]],
['name'=>'unit','label'=>'Units','type'=>'select','options'=>[['metric','Metric (kg, cm)'],['imperial','Imperial (lb, in)']]],
['name'=>'age','label'=>'Age','type'=>'number','placeholder'=>'30','help'=>'Years','min'=>'14','max'=>'100','step'=>'1'],
['name'=>'weight','label'=>'Weight','type'=>'number','placeholder'=>'70','help'=>'kg in metric mode, lb in imperial mode','min'=>'1','step'=>'0.1'],
['name'=>'height','label'=>'Height','type'=>'number','placeholder'=>'175','help'=>'cm in metric mode, inches in imperial mode','min'=>'20','step'=>'0.1'],
['name'=>'activity','label'=>'Activity level','type'=>'select','options'=>[['1.2','Sedentary'],['1.375','Light activity'],['1.55','Moderate activity'],['1.725','Very active'],['1.9','Extra active']]],
['name'=>'goal','label'=>'Goal','type'=>'select','options'=>[['0','Maintain'],['-500','Moderate loss estimate'],['300','Moderate gain estimate']]]
]); ?>
