<?php
# Setup view
    $this->template->content = View::instance('v_posts_index');

# View within a view        
    $this->template->content->signup = View::instance('v_signup');

# Render template
    echo $this->template;
	
?>