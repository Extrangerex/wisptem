const gulp = require("gulp");
var argv = require("yargs").argv;
const fs = require("fs");

gulp.task("update-database", () => {
  return new Promise((resolve, rejects) => {
    var dbPort = argv.dbPort;

    if (!dbPort) {
      rejects("No dbPort params has been passed");
    }

    const currentSql = fs.readFileSync("./wisptem.sql").toString();

    console.log(currentSql.replace(3015, dbPort));

    fs.writeFileSync(`./src/${dbPort}.sql`, currentSql.replace(`3015`, dbPort));

    resolve();
  });
});

module.exports = {
  gulp,
};
