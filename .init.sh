# docs: https://developer.wordpress.org/cli/commands/plugin/

wp rewrite structure '/%year%/%monthnum%/%postname%/'

wp plugin delete hello
wp plugin delete akismet
wp plugin activate ${REPO_NAME}

# wp plugin install https://github.com/NUCSSA/nucssa-core/archive/refs/tags/1.0.zip --activate
