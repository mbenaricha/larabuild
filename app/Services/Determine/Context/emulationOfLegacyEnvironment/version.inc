<?php


if (!defined('X_ITEM')) define('X_ITEM', 1);                 // Code d'association aux lignes
if (!defined('X_REQ')) define('X_REQ', 2);                  // Code d'association aux demandes
if (!defined('X_CMD')) define('X_CMD', 4);                  // Code d'association aux commandes
if (!defined('X_INV')) define('X_INV', 8);                  // Code d'association aux factures
if (!defined('X_QUOT')) define('X_QUOT', 0x10);      // Code d'association sur les devis
if (!defined('X_APPROB')) define('X_APPROB', 0x20);            // Code d'association sur approbation
if (!defined('X_BUDGET')) define('X_BUDGET', 0x40);            // Code d'association sur budgets
if (!defined('X_CONTRACT')) define('X_CONTRACT', 0x80);          // Code d'association sur contrats
if (!defined('X_COMP')) define('X_COMP', 0x100);             // Code d'association sur soci?t?
if (!defined('X_DPT')) define('X_DPT', 0x200);              // Code d'association sur service
if (!defined('X_USER')) define('X_USER', 0x400);              // Associated with a user
if (!defined('X_CAT')) define('X_CAT', 0x800);              // Code d'association sur cat?gories
if (!defined('X_ART')) define('X_ART', 0x1000);             // Code d'association sur articles
if (!defined('X_SUP')) define('X_SUP', 0x2000);             // Code d'association sur fournisseurs
if (!defined('X_DEST')) define('X_DEST', 0x4000);            // Code d'association sur destination
if (!defined('X_CODE')) define('X_CODE', 0x8000);            // Gestion du code g?n?rique
if (!defined('X_POPUP')) define('X_POPUP', 0x10000);           // Affichage sous forme de popup (sinon liste)

// Article type, do not forget to set the associated label in customer specific main.inc : $ITEM_TYPE[IT_ART]='Article'
if (!defined('IT_ART')) define('IT_ART', 1);   // RESERVE Articles (conditionnement)
if (!defined('IT_PREST')) define('IT_PREST', 2);   // Prestations et honoraires
if (!defined('IT_PORT')) define('IT_PORT', 3);   // RESERVE Frais de port
if (!defined('IT_EXP')) define('IT_EXP', 4);   // Frais de d?placement
if (!defined('IT_TRAV')) define('IT_TRAV', 5);   // Voyages
if (!defined('IT_DOT')) define('IT_DOT', 6);   // Dotations (personnel)
if (!defined('IT_MAG')) define('IT_MAG', 7);   // RESERVE Magazines (personnel)
if (!defined('IT_SUBS')) define('IT_SUBS', 8);   // Abonnements
if (!defined('IT_FIN')) define('IT_FIN', 9);   // RESERVE Corrections|?cart manuel
if (!defined('IT_CREDIT')) define('IT_CREDIT', 10);  // RESERVE Avoir|Facture manuel
if (!defined('IT_DEPOSIT')) define('IT_DEPOSIT', 12);  // RESERVE Acompte
if (!defined('IT_TAX')) define('IT_TAX', 14);  // RESERVE Taxes
if (!defined('IT_SC')) define('IT_SC', 16);    // Prestations avec personnel (int?rim, S/T)
if (!defined('IT_GRATIS')) define('IT_GRATIS', 20);  // RESERVE Echantillon gratuit
if (!defined('IT_OD')) define('IT_OD', 30);    // RESERVE Corrections comptables ou reventilation
if (!defined('IT_INVQTY')) define('IT_INVQTY', 40);    // RESERVE (FAC001) Ecart sur QTY sup?rieure
if (!defined('IT_INVPU')) define('IT_INVPU', 41);    // RESERVE (FAC001) Ecart sur PUNET => TODO: to remove, stays for retro-compatibility
if (!defined('IT_INVFLOW')) define('IT_INVFLOW', 42);    // RESERVE (FAC001) Facture ? recevoir
if (!defined('IT_INVCREDIT')) define('IT_INVCREDIT', 43);    // RESERVE (FAC001) Avoir ? recevoir
if (!defined('IT_INVPUINF')) define('IT_INVPUINF', 44);    // RESERVE (FAC001) Ecart sur PUNET inf?rieur
if (!defined('IT_INVPUSUP')) define('IT_INVPUSUP', 45);    // RESERVE (FAC001) Ecart sur PUNET sup?rieur
if (!defined('IT_INVCUR')) define('IT_INVCUR', 46);    // Conversion Rate Discrepancy
if (!defined('IT_INVWTH')) define('IT_INVWTH', 47);    // Invoice Withholding (see SETUP_TAX & 0x200000)
if (!defined('IT_INVBLANKETPO')) define('IT_INVBLANKETPO', 48);    //
if (!defined('IT_BLANKET')) define('IT_BLANKET', 50);    // ?Blanket PO? type - This line should be without manual receiving (don?t use IT_ATTR & 0x10)
if (!defined('IT_REBATE_CREDIT')) define('IT_REBATE_CREDIT', 51); // Rebate/Credit Line type
if (!defined('IT_CONSIGNMENT')) define('IT_CONSIGNMENT', 52); // Consignment type used for deposit lines from punch-out
if (!defined('PB_INVQTYSUP')) define('PB_INVQTYSUP', 1); // Type of problem from invoice file auto reconciliation on the item line when invoice quantity greater than ordered quantity
if (!defined('PB_INVPUINF')) define('PB_INVPUINF', 2); // Type of problem from invoice file auto reconciliation on the item line when invoice PUHT greater than ordered PUHT
if (!defined('PB_INVPUSUP')) define('PB_INVPUSUP', 3); // Type of problem from invoice file auto reconciliation on the item line when invoice PUHT lower than ordered PUHT

/** Types de demandes a gerer */
if (!defined('REQT_DEF')) define('REQT_DEF', 1);
if (!defined('REQT_MAG')) define('REQT_MAG', 2);
if (!defined('REQT_QUOTE')) define('REQT_QUOTE', 4);
if (!defined('REQT_CTR')) define('REQT_CTR', 8);    // Ech?ance contractuelle
if (!defined('REQT_INV')) define('REQT_INV', 16);
//RM-00182
if (!defined('REQT_TRA')) define('REQT_TRA', 80);// Frais de transit

/** Types de priorit?s r?serv?s des demandes */
if (!defined('PRIORITY_AUTO')) define('PRIORITY_AUTO', 0);
if (!defined('PRIORITY_REGUL')) define('PRIORITY_REGUL', 1);
if (!defined('PRIORITY_DATE')) define('PRIORITY_DATE', 2);
if (!defined('PRIORITY_URGENT')) define('PRIORITY_URGENT', 5);
if (!defined('PRIORITY_DEF')) define('PRIORITY_DEF', 30);

if (!defined('DOC_SUPPLIERVIEW')) define('DOC_SUPPLIERVIEW', 0x10);