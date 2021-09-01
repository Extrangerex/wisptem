const gulp = require("gulp");
var argv = require("yargs").argv;
const fs = require("fs");

gulp.task("deploy", () => {
  return new Promise((resolve, rejects) => {
    var { dbPort, appPort } = argv;

    if (!dbPort) {
      rejects("No dbPort param has been passed");
    }

    if (!appPort) {
      rejects("No appPort param has ben passed");
    }

    const currentSql = fs.readFileSync("./wisptem.original.sql").toString();

    fs.writeFileSync(
      `./wisptem.sql`,
      currentSql.replace(new RegExp(39403, "g"), dbPort)
    );

    const dbConfig = fs.readFileSync("./src/config/db.original.php").toString();

    fs.writeFileSync(
      `./src/config/db.php`,
      dbConfig.replace(new RegExp("3940", "g"), dbPort)
    );

    const dockerConfig = fs
      .readFileSync("./docker-compose.original.yml")
      .toString();

    fs.writeFileSync(
      `./docker-compose.yml`,
      dockerConfig.replace(new RegExp("45721:80", "g"), `${appPort}:80`)
    );

    resolve();
  });
});

module.exports = {
  gulp,
};
