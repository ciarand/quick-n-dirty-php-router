<?php namespace Ciarand;

class Router
{
    /**
     * Retrieves the requested script file based on the provided $env array.
     * This is typically the $_SERVER array, but can be from any source.
     *
     * @param array $env
     *
     * @return string
     */
    public static function scriptForEnv(array $env)
    {
        if (!isset($env["SCRIPT_NAME"])) {
            throw new Exception("No script name. Check your server configuration.");
        }

        return static::sanitize(static::addIndex($env["SCRIPT_NAME"]));
    }

    /**
     * Cleans the provided $path by removing any ".."s and making sure that the
     * whole thing is prefixed with a "/"
     *
     * @param string $path
     *
     * @return string
     */
    private static function sanitize($path)
    {
        return "/" . str_replace("../", "", trim($path, "./"));
    }

    /**
     * Appends an "/index.php" to any request that doesn't already end with
     * .php. This will break on weirdly named folders (i.e. if a user requests
     * subdir.php and it happens to be a folder, this will munge it and return
     * "subdir.php" without the index.php file. That's a natural consequence
     * for your poorly named folders.
     *
     * @param string $path
     *
     * @return string
     */
    private static function addIndex($path)
    {
        return substr($path, -4) === ".php"
            ? $path
            : rtrim($path, "/") . "/index.php";
    }
}
