<?php 
App::import('Vendor', 'jpgraph/jpgraph');
App::import('Vendor', 'jpgraph/jpgraph_line');
App::import('Vendor', 'jpgraph/jpgraph_bar');

//bar1
/*
$data1y=array(115,130,135,130,110,130,130,150,130,130,150,120);
//bar2
$data2y=array(180,200,220,190,170,195,190,210,200,205,195,150);
//bar3
$data3y=array(220,230,210,175,185,195,200,230,200,195,180,130);
$data4y=array(40,45,70,80,50,75,70,70,80,75,80,50);
$data5y=array(20,20,25,22,30,25,35,30,27,25,25,45);
//line1
$data6y=array(50,58,60,58,53,58,57,60,58,58,57,50);
foreach ($data6y as &$y) { $y -=10; }
*/
	

// Create the graph. These two calls are always required
$graph = new Graph(860,320,'auto');
$graph->SetScale("textlin");
$graph->SetY2Scale("lin",0,90);
$graph->SetY2OrderBack(false);


$graph->SetMargin(35,50,20,5);

$theme_class = new UniversalTheme;
$graph->SetTheme($theme_class);

$graph->yaxis->SetTickPositions(array(0,50,100,150,200,250,300,350), array(25,75,125,175,275,325));
//$graph->y2axis->SetTickPositions(array(30,40,50,60,70,80,90));

//$months = $gDateLocale->GetShortMonth();
//$months = array_merge(array_slice($months,3,9), array_slice($months,0,3));
$graph->SetBox(false);

$graph->ygrid->SetFill(false);
//$graph->xaxis->SetTickLabels(array('A','B','C','D'));
$graph->yaxis->HideLine(false);
$graph->yaxis->HideTicks(false,false);

$graph->xaxis->SetTickLabels(array("Pendientes","Aprobadas","Rechazadas","Reproceso"));

// Create the bar plots
$b1plot = new BarPlot($data[0]);
$b2plot = new BarPlot($data[1]);

$b3plot = new BarPlot($data[2]);
$b4plot = new BarPlot($data[3]);
$b5plot = new BarPlot($data[4]);
$b6plot = new BarPlot($data[5]);

//$lplot = new BarPlot($data[5]);

// Create the grouped bar plot
//$gbbplot = new AccBarPlot(array($b3plot,$b4plot,$b5plot));
$gbplot = new GroupBarPlot(array($b1plot,$b2plot,$b3plot,$b4plot,$b5plot,$b6plot));

// ...and add it to the graPH
$graph->Add($gbplot);
//$graph->AddY2($lplot);

$b1plot->SetColor("#67ab2b");
$b1plot->SetFillColor("#67ab2b");
$b1plot->SetLegend($ing[0]);
$b1plot->value->setFormat("%d");
$b1plot->value->Show();

$b2plot->SetColor("#92f23c");
$b2plot->SetFillColor("#92f23c");
$b2plot->value->setFormat("%d");
$b2plot->SetLegend($ing[1]);
$b2plot->value->Show();

$b3plot->SetColor("#469400");
$b3plot->SetFillColor("#469400");
$b3plot->value->setFormat("%d");
$b3plot->SetLegend($ing[2]);
$b3plot->value->Show();

$b4plot->SetColor("#3ba3d0");
$b4plot->SetFillColor("#3ba3d0");
$b4plot->SetLegend($ing[3]);
$b4plot->value->setFormat("%d");
$b4plot->value->Show();

$b5plot->SetColor("#0772a1");
$b5plot->SetFillColor("#0772a1");
$b5plot->SetLegend($ing[4]);
$b5plot->value->setFormat("%d");
$b5plot->value->Show();

$b6plot->SetColor("#ffee00");
$b6plot->SetFillColor("#ffee00");
$b6plot->setLegend($ing[5]);
$b6plot->value->setFormat("%d");
$b6plot->value->Show();

/*
$lplot->SetBarCenter();
$lplot->SetColor("yellow");
$lplot->SetLegend("Houses");
$lplot->mark->SetType(MARK_X,'',1.0);
$lplot->mark->SetWeight(2);
$lplot->mark->SetWidth(8);
$lplot->mark->setColor("yellow");
$lplot->mark->setFillColor("yellow");
*/
$graph->legend->SetFrameWeight(1);
$graph->legend->SetColumns(6);
$graph->legend->SetColor('#4E4E4E','#00A78A');


$band = new PlotBand(VERTICAL,BAND_RDIAG,11,"max",'khaki4');
$band->ShowFrame(true);
$band->SetOrder(DEPTH_BACK);
$graph->Add($band);

$graph->title->Set("Ideas por ingeniero");

// Display the graph
$graph->Stroke(getcwd()."/tmp/estadoideasingeniero.png");
$graph->Stroke();


?> 
