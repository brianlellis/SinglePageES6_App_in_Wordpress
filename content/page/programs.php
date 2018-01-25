<?php

$programs   = new Tribe\Project\Programs\Program_Loop();
$loop       = $programs->get_programs_query();

get_template_part( 'content/filters/programs' );

?>

<div id="programs-loop" class="cards program-loop">
	<?php
	while( $loop->have_posts() ) {
		$loop->the_post();
		get_template_part( 'content/loop/program' );
	}
	?>
</div> 