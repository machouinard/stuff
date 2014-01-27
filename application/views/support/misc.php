<?php $this->load->helper('text');
?>

<div class="grid_14 push_1">
<ul>
    <li>
        <h2>Remove all unattached media from WordPress</h2>
        <code><pre>
            $args = array(
            'post_type' => 'attachment',
            'numberposts' => null,
            'post_status' => null,
            'post_parent' => 0,
            'numberposts' => 1000,
           // 1000 is the limit. Refresh the page and 1000 of them will be gone.
            'order' => 'ASC'

           );
           $attachments = get_posts($args);
           if ($attachments) {
            foreach ($attachments as $attachment) {
            echo apply_filters('the_title', $attachment->post_title);
            unlink ( get_attached_file( $attachment->ID , false ));
            wp_delete_post($attachment->ID );
            //the_attachment_link($attachment->ID, false);
            }
           }

            </pre></code>
    </li>
    <li>
        <h2>Error 2002:  Cannot login to the mysql server</h2><br />
        This gave me trouble after installing Logitech's Squeezebox server on Ubuntu Server 11.10<br />
        To install Squeezebox I had to remove the following braces + comma.
        After I got Squeezebox working I noticed I could no longer access Wordpress.
        This worked straight away.
        <code>sudo vi /etc/apparmor.d/usr.sbin.mysqld</code>
        <p>and replace:</p>
        <code>/var/run/mysqld/mysqld.pid w,<br />
        /var/run/mysqld/mysqld.sock w,</code>
        <p>with</p>
        <code>
            /{,var/}run/mysqld/mysqld.pid w,<br />
        /{,var/}run/mysqld/mysqld.sock w,
        </code>
    </li>

    <li><h2>Webmin Installation on Ubuntu Server 11.10</h2>
        Webmin is a web-based interface based on Perl for system administration under Unix-based systems. With Webmin, via your web browser, you can set up new user accounts, manage disk quotas, configure files, control the Apache server as well as MySQL and PHP and more. The info here I found on the web and is what I used to set up Webmin on Ubuntu Server 11.10.<br /><br />

        <strong>Webmin Installation</strong>

        Clearly, before we start you should have installed some sort of LAMP stack on your system. Now follow these instructions to install Webmin on Ubuntu 11.10/11.04:<br /><br />

        1. Open a Terminal and run this command:

        <code>sudo vim /etc/apt/sources.list</code>

        At the end of the file add these two lines, then save and close:

        <code>deb http://download.webmin.com/download/repository sarge contrib<br />
        deb http://webmin.mirror.somersettechsolutions.co.uk/repository sarge contrib</code>

        2. Import the GPG key using these commands:

        <code>wget http://www.webmin.com/jcameron-key.asc<br />
        sudo apt-key add jcameron-key.asc<br />
        sudo apt-get update</code>

        3. Now install Webmin with this command:

        <code>sudo apt-get install webmin</code>

        <strong>Accessing Webmin</strong>

        To start Webmin, open this URL using your web browser:

        <code>https://SERVER_IP:10000/</code>

        To login to webmin, you need to use your root account. If you haven't assigned a password to your root account, you should do so now. <br />Create a root password using this command via the terminal:

        <icode>sudo passwd</icode>

        Enter and confirm a new password. Then use your root account details to login to webmin.
    </li>
    <li>
        <h2>Figuring out when two circles collide for an Xcode project I was working on<br /><span class="mini_text">(assuming they have the same radius)</span></h2>
        <code>
            float dist = ((circle1.origin.x - circle2.origin.x) * (circle1.origin.x - circle2.origin.x)) + <br />((circle1.origin.y - circle2.origin.y) * (circle1.origin.y - circle2.origin.y));<br />
if(dist < diameter * diameter){<br />
//do collision<br />
}
        </code>
        <p>I thought this should've used radius, but it only works properly with diameter.  Go figure.  I'll learn exactly why later.</p>
    </li>


    <li>
        <h2>PHP: the different IF syntax</h2>
        <pre class="prettyprint">
        <php>if() : </php>
        html goes here
        <php>endif</php>
        </pre>
    </li>


</ul>

    </div>