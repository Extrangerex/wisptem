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

    const currentSql = fs.readFileSync("./wisptem.sql").toString();

    fs.writeFileSync(
      `./src/wisptem.sql`,
      currentSql.replace(new RegExp(3015, "g"), dbPort)
    );

    const dbConfig = fs.readFileSync("./src/config/db.php").toString();

    fs.writeFileSync(
      `./src/config/db.php`,
      dbConfig.replace(new RegExp(3015, "g"), dbPort)
    );

    const dockerConfig = fs.readFileSync("./docker-compose.yml").toString();

    fs.writeFileSync(
      `./docker-compose.yml`,
      dockerConfig.replace(new RegExp("5000:80", "g"), `${appPort}:80`)
    );

    resolve();
  });
});

module.exports = {
  gulp,
};
