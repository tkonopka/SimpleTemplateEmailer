# SimpleTemplateEmailer

Php classes with a generic template-filler and a basic email sender.


## Structure

### SimpleTemplateFiller

The template filler is a class that prepares text documents by replacing placeholders with values. The constructor requires a path to a directory on disk. Generation of a document in function `fill` requires a template name and an array. The function loads a relevant text document from the template directory, replaces placeholders with values from the array, and returns a string.

The class can be tuned to change the file extensions associated with template files and the delimiters that define placeholders. It is possible, for example, to replace the default `%PLACEHOLDER%` format by `{{PLACEHOLDER}}`.

### SimpleEmailer

The SimpleEmailer class uses the php `mail` command to send email. The class structure allows setting a default sender address so that emails originate from a consistent address.


### SimpleTemplateEmailer

The templated emailer combines the template filler with the mailer. The first line in the template is interpreted as the email title, the rest of the template as the email body.



## License

MIT


