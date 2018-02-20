# SlabPHP Display and Template Library

This library uses "php" template files to perform lightweight but organized output operations. Files are included in the context of the Template class. Like much SlabPHP this was written a long time ago. It still assumes you might do business logic in your templates even though that's considered bad design. For more information about SlabPHP, please read the documentation in the core library. You may want to consider using something more modern, such as mustache for templating.

A note on security, php template files should be as secure as any other part of your codebase. You need to make sure you are not including template files that you did not author by carefully using correct file system permissions and directory paths. With that said, there is a possibility of loading malicious code if your codebase is compromised. However if your codebase is compromised this library would probably be the least of your worries. 

## Installation and Usage

First include the library

    composer require slabphp/display
    
Next instantiate and display a template.

    $template = new \Slab\Display\Template();
    $template->setTemplateSearchDirectories(['default'=>__DIR__.'/templates']);

    $output = $template->renderTemplate('standard.php', ['name'=>'Sam'], true);
    
As long as the file ~/templates/standard.php exists, it will load it and since the third param is true it will return it to $output; Assuming that file looked like this:

    Hello there <?php echo $this->name; ?>!
    
Then $output would contain "Hello there Sam!"