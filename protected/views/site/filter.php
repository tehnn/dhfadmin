<?php

$this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'gggg',
    'dataProvider'=>$dataProvider,
    //'columns'=>$columns,
    'filter'=>$filtersForm,
));