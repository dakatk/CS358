function menu_goto( menuform )
{
  // Generated by thesitewizard Navigation Menu Wizard 2.3.6
  // Visit http://www.thesitewizard.com/ to get your own
  // customized navigation menu FREE!
  var baseurl = 'http://fujita.valpo.edu/~abrainar/sounding/' ;
  selecteditem = menuform.url.selectedIndex ;
  newurl = menuform.url.options[ selecteditem ].value ;
  if (newurl.length != 0) {
    location.href = baseurl + newurl ;
  }
}
document.writeln( '<form action="chgoto" method="get">' );
document.writeln( '<select name="url" onchange="menu_goto(this.form)">' );
document.writeln( '<option value="091_001.php">11-11-13 at 1705Z</option>' );
document.writeln( '<option value="092_001.php">11-11-13 at 2158Z</option>' );
document.writeln( '<option value="093_001.php">11-12-13 at 0512Z</option>' );
document.writeln( '<option value="093_002.php">11-12-13 at 1411Z</option>' );
document.writeln( '<option value="094_001.php">11-17-13 at 1842Z</option>' );
document.writeln( '<option value="095_001.php">12-11-13 at 2118Z</option>' );
document.writeln( '<option value="096_001.php">12-14-13 at 1711Z</option>' );
document.writeln( '<option value="098_001.php">01-21-14 at 0151Z</option>' );
document.writeln( '<option value="099_001.php">01-22-14 at 0037Z</option>' );
document.writeln( '</select>' );
document.writeln( '</form>' );


