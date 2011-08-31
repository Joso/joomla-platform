#!/usr/bin/env php
<?php
if('cli' != php_sapi_name())
exit('This script must be run from the command line');

$outputFileName = 'status.html';

if($argc < 3)
{
    echo 'Usage: <source> <destination>'."\n";
    exit(1);
}

$sourcePath = $argv[1];
$destinationPath = $argv[2];

$packages = array();

foreach (new DirectoryIterator($sourcePath.'/libraries/joomla') as $d) {
    if($d->isDot()
    || ! $d->isDir())
    continue;

    $packages[] = $d->getFilename();
}//foreach

sort($packages);

require_once 'jmatrix.php';

$matrix = new JMatrix($sourcePath);
$checkStyleCounts = $matrix->getCheckStyleCounts();

ob_start();
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" type="text/css" href="default.css">

<title>Joomla! Platform @ GitHub - Status</title>
</head>
<body>
<!--
**************************************************************
This file (<?php echo $outputFileName; ?>) is auto generated.

!!! Do not change the content !!!
**************************************************************
-->
<a href="http://github.com/joomla/joomla-platform">
<img style="position: absolute; top: 0; right: 0; border: 0;"
src="http://s3.amazonaws.com/github/ribbons/forkme_right_darkblue_121621.png" alt="Fork me on GitHub" />
</a>

<div id="container2">

    <h1><a href="http://github.com/joomla/joomla-platform">Joomla! Platform</a></h1>

    <div class="description">A PHP Application Framework</div>

    <h2>Status Page and Code Metrics</h2>
<!--
    <div class="jpmBox">
		<embed width="300" height="150" type="image/svg+xml" src="build/images/overview-pyramid.svg" />
    </div>
    <div class="jpmBox">
    	<embed width="300" height="150" type="image/svg+xml" src="build/images/overview-pyramid.svg" />
    </div>

    <div style="clear: both;"></div>
 -->


    <div class="jpmBox">
        <h3>Checkstyle</h3>
        <ul>
        	<li><?php echo sprintf('%d files checked' ,$checkStyleCounts->files); ?></li>
        	<li><?php echo sprintf('%d warnings', $checkStyleCounts->warnings); ?></li>
        	<li><?php echo sprintf('%d errors' ,$checkStyleCounts->errors); ?></li>
        </ul>
        <a href="#"<?php //echo JURI::root(true); ?> title="/build/code-browser">
            <?php echo jgettext('Code browser'); ?>
        </a>
    </div>

    <div class="jpmBox">
        <h3>JUnit</h3>
        <?php
        if( ! isset($matrix->junit->testsuite->testsuite))
        {
            echo 'Failure';
        }
        else
        {
            foreach ($matrix->junit->testsuite as $testsuite)
            {
                $attribs = $testsuite->attributes();
                ?>
                <ul>
                	<li><?php echo sprintf(jgettext('Tests: %d'), $attribs->tests); ?></li>
                	<li><?php echo sprintf(jgettext('Assertions: %d'), $attribs->assertions); ?></li>
                	<li><?php echo sprintf(jgettext('Failures: %d'), $attribs->failures); ?></li>
                	<li><?php echo sprintf(jgettext('Errors: %d'), $attribs->errors); ?></li>
                </ul>
            <?php
            }//foreach
            ?>
            <a href="#"<?php //echo JURI::root(true); ?> title="/build/coverage">
                <?php echo jgettext('Coverage report'); ?>
            </a>
            <?php
        }//if
        ?>
    </div>

    <div class="jpmBox">
        <h3>API</h3>
        <a href="http://api.joomla.org"<?php //echo JURI::root(true); ?> title="/build/api/index.xhtml">API Docu</a>
    </div>

    <div style="clear: both;"></div>

    <div class="jpmBox">
        <h3>Class Diagrams</h3>
        <ul>
<?php foreach($packages as $package) :?>
            <li><a href="build/diagrams/<?php echo $package; ?>.png"><?php echo ucfirst($package); ?></a></li>
<?php endforeach; ?>
        </ul>
            <p><a href="build/joomla-class-diagrams.zip">Download zip package</a></p>
    </div>

    <div class="jpmBox">
		<h3>LOC</h3>
        <?php
        if( ! $matrix->loc)
        {
            echo 'Failure';
        }
        else
        {
        ?>
        <ul>
        <?php foreach ($matrix->loc as $key => $value) : ?>
            <li><b><?php echo $key; ?></b>: <?php echo $value; ?></li>
        <?php endforeach; ?>
        </ul>
        <?php
        }
?>
	</div>

    <div style="clear: both;"></div>

    <div class="timestamp"><span>Page generated: <?php echo date('Y-M-d'); ?></span></div>

    <div class="footer">
      get the source code on GitHub : <a href="http://github.com/joomla/joomla-platform">Joomla! Platform</a>
    </div>

</div>

</body>
</html>
<?php
$contents = ob_get_clean();

$h = fopen($destinationPath.'/'.$outputFileName, 'w');

if( ! $h)
{
    echo 'Can not open '.$destinationPath.'/'.$outputFileName;
    exit(1);
}

fwrite($h, $contents);

echo "\nFinished =;)\n";

function jgettext($string) { return $string; }//-- I am a dummy :P

