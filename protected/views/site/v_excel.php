<style>
    .grid-view .pager {
        margin: 5px 0 0 0;
        text-align: right;
    }
    .grid-view .summary {
        margin: 0 0 5px 0;
        text-align: left;
    }
</style>

<?php
/*
  $this->widget('zii.widgets.grid.CGridView', array(
  'id'=>'vwexcel-grid',
  'dataProvider'=>$dataProvider->search(),
  'filter'=>$dataProvider,

  ));
 */
//print_r($merge);
echo CHtml::link('popup', '#', array(
    'onclick' => 'javascript:pop=window.open("index.php?r=Site/Popup","wname","width=500,height=400,left=300,top=10"); pop.focus();return false;'
));
?>



<br>
<form method="POST">

    <?php
    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
        'name' => 'date1',
        'options' => array(            
            'dateFormat' => 'yy-mm-dd', 
        ),        
    ));
    ?>
    <?php
    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
        'name' => 'date2',
        'options' => array(            
            'dateFormat' => 'yy-mm-dd', 
        ),
    ));
    ?>
    <input type="submit"  name="submit" value="ตกลง...">
</form>

<?php
$this->widget('application.components.tlbExcelView', array(
    'id' => 'case-grid',
    'dataProvider' => $dataProvider->search($merge),
    'filter' => $dataProvider,
    'grid_mode' => $production, // Same usage as EExcelView v0.33
    'summaryText' => 'แสดงผล {start}-{end} จาก {count} แถว',
    'template' => "{exportbuttons}{pager}{summary}\n{items}",
    'title' => 'รายชื่อ_' . date('Y_m_d'),
    'creator' => 'UTEHN PHNU',
    'subject' => mb_convert_encoding('Something important with a date in French: ' . utf8_encode(strftime('%e %B %Y')), 'ISO-8859-1', 'UTF-8'),
    'description' => mb_convert_encoding('Etat de production généré à la demande par l\'administrateur (some text in French).', 'ISO-8859-1', 'UTF-8'),
    'lastModifiedBy' => 'UTEHN PHNU',
    'sheetTitle' => 'Sheet1',
    'keywords' => '',
    'category' => '',
    'landscapeDisplay' => True, // Default: false
    'A4' => TRUE, // Default: false - ie : Letter (PHPExcel default)
    'RTL' => false, // Default: false - since v1.1
    'pageFooterText' => '&RThis is page no. &P of &N pages', // Default: '&RPage &P of &N'
    'automaticSum' => false, // Default: false
    'decimalSeparator' => ',', // Default: '.'
    'thousandsSeparator' => '.', // Default: ','
    //'displayZeros'       => false,
    //'zeroPlaceholder'    => '-',
    'sumLabel' => 'Column totals:', // Default: 'Totals'
    'borderColor' => '000000', // Default: '000000'
    'bgColor' => 'FFFFFF', // Default: 'FFFFFF'
    'textColor' => '000000', // Default: '000000'
    'rowHeight' => 15, // Default: 15
    'headerBorderColor' => '000000', // Default: '000000'
    'headerBgColor' => 'CCCCCC', // Default: 'CCCCCC'
    'headerTextColor' => '000000', // Default: '000000'
    'headerHeight' => 20, // Default: 20
    'footerBorderColor' => '0000FF', // Default: '000000'
    'footerBgColor' => '00FFCC', // Default: 'FFFFCC'
    'footerTextColor' => 'FF00FF', // Default: '0000FF'
    'footerHeight' => 20, // Default: 20
        //'columns'              => array('prename','name','lname',) // an array of your CGridColumns
));
?>