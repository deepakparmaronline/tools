# Evidence ledger

Checked 2026-10-14, Asia/Kolkata. Official sources support product claims; billing units, commitments and exclusions are preserved.

| Product/source | Verified fact | Official URL | Checked | Qualification |
|---|---|---|---|---|
| Nylas pricing | Free5combinedaccounts;Essentials15USD10combined10cal;Pro49monthly43annual25combined35cal;NotetakerAgentAccountsquotasseparate | https://www.nylas.com/pricing/ | 2026-10-14 IST | Currentbundle,extraaccountsupportauthdependencies |
| Aurinko | Unifiedmail/cal/contact/task plusprebuiltsync | https://www.aurinko.io/ | 2026-10-14 IST | Noengineering-savingsclaim |
| Aurinko docs | Unifieddeltas/webhooks/pass-through/tokenrefresh/subscriptions | https://docs.aurinko.io/ | 2026-10-14 IST | Limitedcontrolcache,notsecurityguarantee |
| Aurinko pricing | Unifiedfrom1/account/mo<1GB,1.5<5GB,2unlimited;BrightSync2/3/4userscopes | https://www.aurinko.io/pricing/ | 2026-10-14 IST | ConfirmAPIcombinationcharge |
| Unipile email | GmailOutlookIMAPsend/read/folders/webhooks | https://www.unipile.com/email-api/ | 2026-10-14 IST | Providerpermissions |
| Unipile price | EUR49minimum10accounts;11to50tier5/account/mo;GmailOutlookemail+caloneaccount;Scheduler/calwebhookssoon | https://www.unipile.com/pricing-api/ | 2026-10-14 IST | Noadditionalrequest/messageusagefee,providerlimitsremain |
| Cronofy scope | Calendars/availability/scheduling/meetingtranscription | https://www.cronofy.com/developers | 2026-10-14 IST | NoemailmailboxAPIinferred |
| Cronofy OEM | Emerging819USD/moannual500synced2000invites500appcal;Growth2399;additionalunits;MeetingAgentsusage | https://www.cronofy.com/pricing | 2026-10-14 IST | Directorglicensedifferent,recordingquote |
| EmailEngine | SelfhostmailRESTGmailM365IMAP,Redis,1450USDor1200EUR/yearexVATunlimitedmailboxes/instances;14daytrial | https://emailengine.app/ | 2026-10-14 IST | NotcalendarAPI,nopermanentfree |
| Google Gmail | AuthorizedmailboxRESTsend/draft/labels/notifications | https://developers.google.com/workspace/gmail/api/guides | 2026-10-14 IST | Googleonly |
| Google Calendar | Calendars/events/recurrence/ACL | https://developers.google.com/workspace/calendar/api/guides/overview | 2026-10-14 IST | Notcrossprovider |
| Gmail quotas | May12026newprojectquotas/legacyretained;dailybillingthreshold;ratesannouncementlater | https://developers.google.com/workspace/gmail/api/reference/quota | 2026-10-14 IST | Nouniversalforeverfreeclaim |
| Google scopes | OAuthconsent/permissions/publicverification | https://developers.google.com/workspace/gmail/api/auth/scopes | 2026-10-14 IST | Reviewactualpermissions |
| Graph | Microsoftmail/calendar/contactscope | https://learn.microsoft.com/en-us/graph/overview | 2026-10-14 IST | No universalAPIprice inferred |
| Graph auth | Appregistration/delegated/applicationaccess | https://learn.microsoft.com/en-us/graph/auth/auth-concepts | 2026-10-14 IST | Consentnotportableassumption |
| Graph limits | 429Retry-After/backoff | https://learn.microsoft.com/en-us/graph/throttling | 2026-10-14 IST | Noreliabilitybenchmark |

## Evidence handling

Search tool returned revoked OAuth401; continued public official research via HTTP and current Google results via browser. Inspected Unipile/Aurinko/Cronofy comparison leads, Apiroc and Cal.com scheduling article; read Unipile/Aurinko comparison pages for intent; the observed Cal.com result returned 404, so its contents were not used. Vendor rankings/complaints/oldrateclaims not adopted. Broad directories with unrelated CPaaS/CRM apps not treated as like-for-like. https://www.google.com/search?q=Nylas+alternatives .

Scope focuses connected email/calendar, not entireNylasNotetaker/hostedAgent bundle. Aurinko perAPIcombination/transferquote confirmation; BrightSync separate. Unipile calendarScheduler/webhooks markedcomingsoon, nofullschedulerpromise. Cronofy OEMnotDirect,Recordingseparate. EmailEngine paidsubscriptionnotfree/performance capacityunlimited. GooglequotasupdatedMay1newproject/legacy distinction and billingthreshold, unpublishedratesnotinvented. Graphlicences/endpointsfeesnotuniversalfree. No tokenportability,compliance,uptime or migration outcome guarantees.
