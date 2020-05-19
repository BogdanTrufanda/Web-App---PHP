function showpass()
{
var pass = document.getElementById("passwordid");

if (pass.type === "password")
{
    pass.type = "text";
} 
else 
{
    pass.type = "password";
}
}