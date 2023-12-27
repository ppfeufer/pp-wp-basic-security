<?php

namespace WordPress\Ppfeufer\Plugin\WpBasicSecurity;

spl_autoload_register(callback: '\WordPress\Ppfeufer\Plugin\WpBasicSecurity\autoload');

function autoload($className): void {
    // If the specified $className does not include our namespace, duck out.
    if (!str_contains($className, 'WordPress\Ppfeufer\Plugin\WpBasicSecurity')) {
        return;
    }

    $fileName = null;

    // Split the class name into an array to read the namespace and class.
    $fileParts = explode(separator: '\\', string: $className);

    // Do a reverse loop through $fileParts to build the path to the file.
    $namespace = '';

    for ($i = count(value: $fileParts) - 1; $i > 0; $i--) {
        // Read the current component of the file part.
        $current = str_ireplace(search: '_', replace: '-', subject: $fileParts[$i]);
        $namespace = '/' . $current . $namespace;

        // If we're at the first entry, then we're at the filename.
        if (count(value: $fileParts) - 1 === $i) {
            $namespace = '';
            $fileName = $current . '.php';

            /**
             * If 'interface' is contained in the parts of the file name, then
             * define the $file_name differently so that it's properly loaded.
             * Otherwise, just set the $file_name equal to that of the class
             * filename structure.
             */
            if (stripos($fileParts[count(value: $fileParts) - 1], 'interface')) {
                // Grab the name of the interface from its qualified name.
                $interfaceNameParts = explode(
                    separator: '_', string: $fileParts[count($fileParts) - 1]
                );
                $interfaceName = $interfaceNameParts[0];

                $fileName = $interfaceName . '.php';
            }
        }

        // Now build a path to the file using mapping to the file location.
        $filepath = trailingslashit(
            value: dirname(path: __FILE__, levels: 2) . $namespace
        );
        $filepath .= $fileName;

        // If the file exists in the specified path, then include it.
        if ($fileName !== null && file_exists(filename: $filepath)) {
            include_once($filepath);
        }
    }
}
