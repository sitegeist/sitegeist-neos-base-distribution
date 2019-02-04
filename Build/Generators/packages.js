const fs = require('fs');
const path = require('path');

module.exports = fs
    .readdirSync('./DistributionPackages')
    .filter(file => {
        const stats = fs.lstatSync(path.join('./DistributionPackages', file));
        if (stats.isSymbolicLink()) {
            return false;
        }
        const isDir = stats.isDirectory();
        const isNotDotFile = path.basename(file).indexOf('.') !== 0;
        return isDir && isNotDotFile;
    })
    .sort();