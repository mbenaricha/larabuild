#!/usr/bin/env bash

source .env

# customers applis
#APPS_CONF_LIST="p/product d/dp2p b/buildersandbox c/cesi"

APP_LIST0="p/product d/dp2p b/buildersandbox"
APP_LIST1="a/aeronantes a/arkema b/but b/but/branches/but_prod"
APP_LIST2=" c/cesi c/cerbuy c/ciup d/daccor2 d/daccor2/branches/daccor2_prod d/dasco d/domitys d/domitys/branches/domitys_prod"
APP_LIST3="e/economatarmees e/economatarmees/branches/eda_prod e/eda e/easybuy/ e/exane e/exane/branches/exane_prod"
APP_LIST4="g/gtt i/idex i/invivo m/monoprix m/monoprix/branches/monoprix_prod n/nexity n/norauto n/norauto_evo r/rrg"
APP_LIST5="r/rcibanque s/sqli t/talen t/thestudenthotel"
APP_LIST6=" v/valeo v/valeo/branches/valeo_prod v/vivalto v/vivadour v/vivadour_evo v/vmzinc v/vmzinc/branches/vmzinc_prod"
APP_LIST7="v/vetoquinol v/vse w/wrci y/ysl y/ysl/branches/ysl_prod"

APPS_CONF_LIST="${APP_LIST0} ${APP_LIST1} ${APP_LIST2} ${APP_LIST3} ${APP_LIST4} ${APP_LIST5} ${APP_LIST6} ${APP_LIST7}"


# local settings
CURRENT_SCRIPT=$(realpath "${BASH_SOURCE}")
CURRENT_SCRIPT_PATH=$(dirname "${CURRENT_SCRIPT}")
SVN_EXEPATH="${CURRENT_SCRIPT_PATH}/svn/bin"

# document root
DOC_ROOT_PATH="."

# appli path
APPLI_PATH="${DOC_ROOT_PATH}/appli"

#echo "DOC_ROOT_PATH ${DOC_ROOT_PATH}"
#echo "APPLI_PATH ${APPLI_PATH}"
#echo "CURRENT_SCRIPT   ${CURRENT_SCRIPT}"
#echo "CURRENT_SCRIPT_PATH   ${CURRENT_SCRIPT_PATH}"
#echo "APPS_CONF_LIST ${APPS_CONF_LIST}"
#echo "SVN_EXEPATH ${SVN_EXEPATH}"
#exit


# processing
clear

for conf in ${APPS_CONF_LIST}; do
  # here we expect [a-z]{1}/custId|custId as svn path
  custId=${conf}
  custVersionPrefix=""

  if [ "${conf:1:1}" == "/" ]; then
    custLetter=${conf:0:1}
    custVersionPrefix="${conf:0:2}"
    custId=${conf#$custVersionPrefix}
  fi

  if [ -d "${APPLI_PATH}/${custId}" ]; then
    echo "${APPLI_PATH}/${custId} already exist"
    echo "************************************* updating ************************************* ${APPLI_PATH}/${custId}"
    ${SVN_EXEPATH}/svn update --username "${SVN_USER}" --password "${SVN_PASS}" "${APPLI_PATH}/${custId}"
    echo "------------------------------------------------------------------------------------"
  else
    echo "${APPLI_PATH}/${custId}  :  new appli"
    echo "*********************************** checking out *********************************** ${APPLI_PATH}/${custId}"
    ${SVN_EXEPATH}/svn co --username "${SVN_USER}" --password "${SVN_PASS}" "${SVN_URL}/appli/${custVersionPrefix}${custId}/trunk/" "${APPLI_PATH}/${custId}"
    echo "------------------------------------------------------------------------------------"
  fi

done
