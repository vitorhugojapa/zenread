<?php
//default pagination in case of jetpack is not installed or infinite-scroll not active	
if( !class_exists( 'Jetpack' ) || !Jetpack::is_module_active( 'infinite-scroll' ) ): ?>

	<nav id="pagination">

		<?php customPagination(); ?>

	</nav>

<?php endif; ?>